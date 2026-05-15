<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    // Tampilkan daftar equipment
    public function index()
    {
        $equipments = Equipment::all();
        return view('dashboard.equipment.index', compact('equipments'));
    }

    // Form create equipment
    public function create()
    {
        return view('dashboard.equipment.form');
    }

    // Simpan equipment baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only(['name', 'description', 'price', 'quantity']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/equipment'), $imageName);
            $data['image'] = 'equipment/' . $imageName;
        }

        Equipment::create($data);

        return redirect()->route('admin.equipment.index')->with('success', 'Equipment berhasil ditambahkan!');
    }

    // Form edit equipment
    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('dashboard.equipment.form', compact('equipment'));
    }

    // Update equipment
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $equipment = Equipment::findOrFail($id);
        $data = $request->only(['name', 'description', 'price', 'quantity']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($equipment->image && file_exists(public_path('storage/' . $equipment->image))) {
                unlink(public_path('storage/' . $equipment->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/equipment'), $imageName);
            $data['image'] = 'equipment/' . $imageName;
        }

        $equipment->update($data);

        return redirect()->route('admin.equipment.index')->with('success', 'Equipment berhasil diperbarui!');
    }

    // Hapus equipment
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);
        
        // Delete image if exists
        if ($equipment->image && file_exists(public_path('storage/' . $equipment->image))) {
            unlink(public_path('storage/' . $equipment->image));
        }
        
        $equipment->delete();

        return redirect()->route('admin.equipment.index')->with('success', 'Equipment berhasil dihapus!');
    }
}
