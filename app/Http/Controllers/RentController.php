<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment; 
use App\Models\Rent;     
use App\Models\RentItem;  
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;        

class RentController extends Controller
{
    public function index()
    {
        // get tanggal hari ini/input user
        $selectedDate = request('date') ? Carbon::parse(request('date')) : Carbon::today();
        
        $equipments = Equipment::all();
        
        // perbarui ketersediaan berdasarkan tanggal
        foreach ($equipments as $equipment) {
            $totalStock = $equipment->quantity ?? 0;

            $rentedCount = RentItem::where('equipment_id', $equipment->id)
                ->whereHas('rent', function($query) use ($selectedDate) {

                    $query->whereDate('start_date', '<=', $selectedDate)
                        ->whereDate('end_date', '>=', $selectedDate)
                        ->whereIn('status', ['paid', 'rented', 'returned']);
                })
                ->sum('quantity');
            
            \Log::info("Equipment: {$equipment->name}, Total: {$totalStock}, Rented: {$rentedCount}, Available: " . ($totalStock - $rentedCount));
            
            // total available
            $equipment->available = $totalStock - $rentedCount;
            $equipment->is_available = $equipment->available > 0;
        }
        
        return view('page.rent', compact('equipments', 'selectedDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
            'name'       => 'required|string',
            'email'      => 'required|email',
            'phone'      => 'required',
        ]);

        if (!Auth::check()) {
            return back()->with('error', 'Silakan login terlebih dahulu.');
        }

        // parse tanggal
        try {
            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
        } catch (\Exception $e) {
            return back()->with('error', 'Format tanggal tidak valid.');
        }

        // total hari - ini adlah carbon 
        $days = $start->diffInDays($end) ?: 1;

        $grandTotal = 0;
        $itemsToInsert = [];

        if ($request->has('items')) {
            foreach ($request->items as $equipmentId => $qty) {
                $qty = (int) $qty;
                
                if ($qty > 0) {
                    $equipment = Equipment::find($equipmentId);
                    
                    if ($equipment) {
                        $subtotal = $equipment->price * $qty * $days;
                        $grandTotal += $subtotal;

                        $itemsToInsert[] = [
                            'equipment_id' => $equipmentId,
                            'quantity' => $qty,
                            'price_per_day' => $equipment->price,
                            'subtotal' => $subtotal,
                        ];
                    }
                }
            }
        }

        if (empty($itemsToInsert)) {
            return back()->with('error', 'Pilih minimal satu barang untuk disewa.');
        }
        // buat kode transaksi unik
        $trxCode = 'RNT-' . time();

        try {
            $rent = Rent::create([
                'user_id'       => Auth::id(),
                'code'          => $trxCode,
                'start_date'    => $start,
                'end_date'      => $end,
                'duration_days' => $days,
                'total_price'   => $grandTotal,
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'status'        => 'unpaid',
            ]);

            foreach ($itemsToInsert as $item) {
                $rent->items()->create($item);
            }

            return redirect()->route('rent.payment', ['id' => $rent->id]);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function payment($id)
    {
        $rent = Rent::with('items.equipment')->findOrFail($id);

        if ($rent->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('page.payment-rent', compact('rent'));
    }

    public function submitPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $rent = Rent::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $imageName = time() . '_rent.' . $request->payment_proof->extension();
            $request->payment_proof->move(public_path('payment_proofs'), $imageName);
            
            $rent->payment_proof = $imageName;
            $rent->status = 'waiting_verification';
            $rent->save();
        }

        return view('page.success-rent', compact('rent'));
    }

    // Cek ketersediaan barang via AJAX
    public function checkAvailability(Request $request)
    {
        $date = request('date') ? Carbon::parse(request('date')) : Carbon::today();
        $equipments = Equipment::all();
        
        $data = [];
        
        foreach ($equipments as $equipment) {
            $totalStock = $equipment->quantity ?? 0;
            
            $rentedCount = RentItem::where('equipment_id', $equipment->id)
                ->whereHas('rent', function($query) use ($date) {
                    $query->whereDate('start_date', '<=', $date)
                            ->whereDate('end_date', '>=', $date)
                            ->whereIn('status', ['paid', 'rented', 'returned']);
                })
                ->sum('quantity');
            
            $available = $totalStock - $rentedCount;
            
            $data[] = [
                'id' => $equipment->id,
                'available' => $available,
                'is_available' => $available > 0
            ];
        }
        
        return response()->json($data);
    }
}