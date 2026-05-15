@extends('app')

@section('content')
<main class="pt-32 pb-20 bg-white min-h-screen flex flex-col items-center">
    
    <div class="text-center mb-8 px-4">
        <span class="text-bedengan-primary font-medium text-sm tracking-wide uppercase">Gear Up</span>
        <h1 class="font-serif text-4xl md:text-5xl font-bold text-bedengan-dark mt-2 mb-4">Equipment Rental</h1>
        <p class="text-gray-500">Your rental is confirmed</p>
    </div>

    <div class="flex justify-center items-center gap-4 mb-12">
        <div class="w-12 h-12 rounded-full bg-bedengan-primary text-white flex items-center justify-center font-bold shadow-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        
        <div class="w-20 h-1 bg-bedengan-primary rounded-full"></div>
        
        <div class="w-12 h-12 rounded-full bg-bedengan-primary text-white flex items-center justify-center font-bold shadow-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        
        <div class="w-20 h-1 bg-bedengan-primary rounded-full"></div>
        
        <div class="w-12 h-12 rounded-full bg-bedengan-primary text-white flex items-center justify-center font-bold shadow-lg transform scale-110">3</div>
    </div>

    <div class="w-full max-w-3xl px-4">
        <div class="bg-white rounded-[2rem] p-8 md:p-10 border border-gray-100 shadow-xl text-center">
            
            <div class="flex justify-center mb-8">
                <div class="w-24 h-24 bg-bedengan-surface rounded-full flex items-center justify-center">
                    <div class="w-12 h-12 rounded-full border-4 border-bedengan-primary flex items-center justify-center">
                        <svg class="w-6 h-6 text-bedengan-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <h2 class="font-serif text-3xl md:text-4xl font-bold text-bedengan-dark mb-4">
                Rental Submitted!
            </h2>

            <p class="text-gray-500 mb-10 leading-relaxed max-w-xl mx-auto">
                Thank you, <span class="uppercase font-semibold text-gray-700">{{ $rent->name }}!</span> We've received your rental request. You'll receive a confirmation email at 
                    <span class="font-semibold text-gray-700">{{ $rent->email }}</span> 
                within 24 hours.
            </p>

            <div class="bg-gray-200/50 rounded-2xl p-8 text-left mb-10 max-w-xl mx-auto">
                <h3 class="font-serif text-lg font-bold text-bedengan-dark mb-3">Rental Summary</h3>
                
                <div class="space-y-2 text-gray-600 text-sm">
                    <div class="flex gap-2">
                        <span class="w-32">Rental Period:</span>
                        <span class="font-medium text-gray-800">
                            {{ \Carbon\Carbon::parse($rent->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($rent->end_date)->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <span class="w-32">Duration:</span>
                        <span class="font-medium text-gray-800">{{ $rent->duration_days }} day(s)</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="w-32">Items:</span>
                        <span class="font-medium text-gray-800">{{ count($rent->items) }} equipment</span>
                    </div>
                    <div class="flex gap-2 mt-3 pt-3 border-t border-gray-300">
                        <span class="w-32 font-bold text-bedengan-primary">Total:</span>
                        <span class="font-bold text-bedengan-primary">
                            Rp {{ number_format($rent->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ url('/') }}" class="inline-block bg-bedengan-primary hover:bg-green-600 text-white font-medium px-10 py-3 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5">
                Back to Home
            </a>

        </div>
    </div>

</main>
@endsection
