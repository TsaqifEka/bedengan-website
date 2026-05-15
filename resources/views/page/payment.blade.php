@extends('app')

@section('content')
<main class="pt-24 pb-20 bg-white min-h-screen">
    
    <div class="text-center mb-8 px-4">
        <span class="text-bedengan-primary font-medium text-sm tracking-wide uppercase">Book Your Visit</span>
        <h1 class="font-serif text-4xl md:text-5xl font-bold text-bedengan-dark mt-2 mb-4">Ticket Booking</h1>
        <p class="text-gray-500">Reserve your spot at Bedengan Camping Ground</p>
    </div>

    <div class="flex justify-center items-center gap-4 mb-12">
        <div class="w-10 h-10 rounded-full bg-bedengan-primary text-white flex items-center justify-center font-bold">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="w-16 h-1 bg-bedengan-primary rounded-full"></div>
        <div class="w-10 h-10 rounded-full bg-bedengan-primary text-white flex items-center justify-center font-bold shadow-lg shadow-green-500/30">2</div>
        <div class="w-16 h-1 bg-gray-200 rounded-full"></div>
        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">3</div>
    </div>

    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-xl">
            
            <h3 class="font-serif text-2xl font-bold text-bedengan-dark mb-6">Payment</h3>

            <form action="{{ route('booking.submit_payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_method" id="payment_method_input" value="bank">

                <div class="flex gap-4 mb-6">
                    <button type="button" onclick="switchMethod('bank')" id="btn-bank" class="flex-1 py-3 px-4 rounded-xl border-2 border-bedengan-primary bg-bedengan-surface text-bedengan-dark font-semibold transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Bank Transfer
                    </button>
                    <button type="button" onclick="switchMethod('qris')" id="btn-qris" class="flex-1 py-3 px-4 rounded-xl border-2 border-gray-100 text-gray-500 font-semibold hover:border-bedengan-primary/50 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        QRIS
                    </button>
                </div>

                <div class="bg-bedengan-surface rounded-xl p-6 mb-8 border border-bedengan-primary/20">
                    
                    <div id="content-bank">
                        <h4 class="font-serif text-lg font-bold text-bedengan-dark mb-4">Transfer Details</h4>
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Bank:</span>
                                <span class="font-semibold text-gray-800">BCA</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Account Number:</span>
                                <span class="font-semibold text-gray-800 flex items-center gap-2">
                                    1234567890 
                                    <button type="button" class="text-bedengan-primary text-xs hover:underline" onclick="alert('Copied!')">Copy</button>
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span>Account Name:</span>
                                <span class="font-semibold text-gray-800">Bedengan Camping</span>
                            </div>
                            <div class="border-t border-bedengan-primary/20 my-3"></div>
                            <div class="flex justify-between items-center">
                                <span class="text-bedengan-dark font-medium">Amount to Pay:</span>
                                <span class="text-bedengan-primary font-bold text-xl">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div id="content-qris" class="hidden text-center">
                        <h4 class="font-serif text-lg font-bold text-bedengan-dark mb-4">Scan QRIS</h4>
                        <div class="bg-white p-4 rounded-lg inline-block shadow-sm mb-4">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=BayarTagihan{{$booking->id}}" alt="QRIS Code" class="w-40 h-40">
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Scan with GoPay, OVO, Dana, ShopeePay, or Mobile Banking.</p>
                        <div class="font-bold text-bedengan-primary text-xl">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Upload Proof of Payment</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 flex flex-col items-center justify-center text-center cursor-pointer hover:border-bedengan-primary hover:bg-gray-50 transition-all group relative">
                        <input type="file" name="payment_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewFile(this)" required>
                            
                        <div id="upload-placeholder">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-3 mx-auto group-hover:text-bedengan-primary group-hover:bg-green-50 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <p class="text-sm text-gray-600 font-medium">Click to upload or drag and drop</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG up to 5MB</p>
                        </div>

                        <div id="upload-success" class="hidden flex-col items-center gap-2 text-bedengan-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="font-medium" id="file-name">File Selected</span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('booking.index') }}" class="flex-1 py-3 rounded-xl border border-gray-300 text-gray-600 font-semibold text-center hover:bg-gray-50 transition flex items-center justify-center">
                        Back
                    </a>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-bedengan-primary text-white font-semibold text-center hover:bg-green-600 shadow-lg shadow-green-500/30 transition hover:-translate-y-0.5 flex items-center justify-center">
                        Submit Booking
                    </button>
                </div>

            </form>
            </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function switchMethod(method) {
        // Update hidden input
        document.getElementById('payment_method_input').value = method;

        const btnBank = document.getElementById('btn-bank');
        const btnQris = document.getElementById('btn-qris');
        const contentBank = document.getElementById('content-bank');
        const contentQris = document.getElementById('content-qris');

        // Style Default
        const activeClass = "border-bedengan-primary bg-bedengan-surface text-bedengan-dark".split(" ");
        const inactiveClass = "border-gray-100 text-gray-500 hover:border-bedengan-primary/50".split(" ");

        if (method === 'bank') {
            // Aktifkan Bank
            btnBank.classList.remove(...inactiveClass);
            btnBank.classList.add(...activeClass);
            
            // Nonaktifkan QRIS
            btnQris.classList.remove(...activeClass);
            btnQris.classList.add(...inactiveClass);
            
            contentBank.classList.remove('hidden');
            contentQris.classList.add('hidden');
        } else {
            // Aktifkan QRIS
            btnQris.classList.remove(...inactiveClass);
            btnQris.classList.add(...activeClass);
            
            // Nonaktifkan Bank
            btnBank.classList.remove(...activeClass);
            btnBank.classList.add(...inactiveClass);
            
            contentQris.classList.remove('hidden');
            contentBank.classList.add('hidden');
        }
    }

    function previewFile(input) {
        const placeholder = document.getElementById('upload-placeholder');
        const success = document.getElementById('upload-success');
        const fileName = document.getElementById('file-name');

        if (input.files && input.files[0]) {
            placeholder.classList.add('hidden');
            success.classList.remove('hidden');
            success.classList.add('flex');
            fileName.innerText = input.files[0].name;
        }
    }
</script>
@endpush