@extends('app')

@section('title', 'Moment - Bedengan Camping Ground')

@section('content')

    <section class="h-20 bg-transparent"></section> 
    
    {{-- Header --}}
    <div class="text-center mb-12 px-4">
        <span class="text-bedengan-primary font-medium text-sm tracking-wide uppercase">Community Stories</span>
        <h1 class="font-serif text-4xl md:text-5xl font-bold text-bedengan-dark mt-2 mb-4">Bedengan Moments</h1>
        <p class="text-gray-500 text-sm">Discover experiences shared by fellow campers and share your own story</p>
        
        <button onclick="openModal()" class="mt-8 bg-bedengan-primary hover:bg-green-600 text-white font-semibold px-8 py-3 rounded-full shadow-lg shadow-green-500/30 transition-all flex items-center gap-2 mx-auto transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Share Your Moment
        </button>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg max-w-md mx-auto">
                {{ session('success') }}
            </div>
        @endif
        
        {{-- Pesan Error Validasi --}}
        @if ($errors->any())
            <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg max-w-md mx-auto text-sm text-left">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Statistik Dinamis --}}
    <div class="max-w-4xl mx-auto px-4 mb-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-2xl p-6 text-center border border-gray-100">
                <div class="text-3xl font-bold text-bedengan-primary mb-1">{{ $totalReviews }}</div>
                <div class="text-gray-500 text-sm">Reviews</div>
            </div>
            <div class="bg-gray-50 rounded-2xl p-6 text-center border border-gray-100">
                <div class="text-3xl font-bold text-bedengan-primary mb-1">{{ $avgRating }}</div>
                <div class="text-gray-500 text-sm">Avg Rating</div>
            </div>
            <div class="bg-gray-50 rounded-2xl p-6 text-center border border-gray-100">
                <div class="text-3xl font-bold text-bedengan-primary mb-1">{{ $fiveStarCount }}</div>
                <div class="text-gray-500 text-sm">5-Star Reviews</div>
            </div>
        </div>
    </div>

    {{-- Daftar Review (Looping) --}}
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
        
        @forelse($reviews as $review)
            <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition-all hover:bg-white group h-full flex flex-col">
                <div class="flex items-center gap-4 mb-4">
                    {{-- Avatar Inisial --}}
                    <div class="w-12 h-12 rounded-full bg-bedengan-surface flex items-center justify-center text-bedengan-primary font-bold text-xl uppercase shrink-0">
                        {{ substr($review->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 line-clamp-1">{{ $review->user->name }}</h4>
                        {{-- Tanggal Format (ex: December 2025) --}}
                        <p class="text-xs text-gray-400">{{ $review->created_at->format('F Y') }}</p>
                    </div>
                </div>
                
                {{-- Bintang Rating Dinamis --}}
                <div class="flex text-yellow-400 mb-4 text-sm">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            ★
                        @else
                            <span class="text-gray-300">★</span>
                        @endif
                    @endfor
                </div>

                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $review->comment }}
                </p>
            </div>
        @empty
            <div class="col-span-1 md:col-span-3 text-center text-gray-400 py-10">
                <p>No moments shared yet. Be the first one!</p>
            </div>
        @endforelse

    </div>

    <section class="h-20 bg-transparent"></section> 

    {{-- MODAL FORM (Hidden by default) --}}
    <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center px-4">
        <div class="bg-white rounded-3xl p-8 max-w-lg w-full transform transition-all scale-95 opacity-0" id="modalContent">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-serif text-2xl font-bold text-bedengan-dark">Share Experience</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('moment.store') }}" method="POST">
                @csrf
                
                {{-- Input Rating Bintang --}}
                <div class="mb-6">
                    <label class="block text-sm text-gray-600 mb-2">How was your stay?</label>
                    <div class="flex gap-2 flex-row-reverse justify-end group/rating">
                        {{-- Teknik CSS Star Rating: Input radio disembunyikan, label yang diklik --}}
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" id="star{{$i}}" value="{{$i}}" class="peer hidden" required>
                            <label for="star{{$i}}" class="text-3xl text-gray-300 cursor-pointer peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 transition-colors">★</label>
                        @endfor
                    </div>
                </div>

                {{-- Input Komentar --}}
                <div class="mb-6">
                    <label class="block text-sm text-gray-600 mb-2">Tell us about it</label>
                    <textarea name="comment" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:border-bedengan-primary resize-none" placeholder="The scenery was amazing..." required></textarea>
                </div>

                @auth
                    <button type="submit" class="w-full bg-bedengan-primary hover:bg-green-600 text-white font-bold py-3 rounded-xl transition-colors">
                        Post Review
                    </button>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl transition-colors">
                        Login to Review
                    </a>
                @endauth
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    const modal = document.getElementById('reviewModal');
    const modalContent = document.getElementById('modalContent');

    function openModal() {
        modal.classList.remove('hidden');
        // Sedikit delay biar animasi transisi jalan
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Tutup modal kalau klik area hitam di luar
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
</script>
@endpush