<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bedengan Camping Ground')</title>
    <meta name="description" content="Sewa lahan camping dan peralatan outdoor terlengkap di Bumi Perkemahan Bedengan Malang. Booking tiket online sekarang dengan mudah dan aman.">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bedengan: {
                            dark: '#0f3923',    
                            primary: '#22c55e', 
                            light: '#4ade80',   
                            surface: '#f0fdf4', 
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        html { scroll-behavior: smooth; }
        .animate-fade-in { animation: fadeIn 0.2s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-white font-sans text-gray-700 antialiased">

{{-- 
    LOGIKA NAVBAR UTAMA:
    Jika Home: Mulai dengan transparan (nanti dihandle JS saat scroll).
    Jika Bukan Home: Langsung putih shadow (seperti state 'scrolled').
--}}
<header id="navbar"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-3 
    {{ request()->routeIs('home') ? 'bg-transparent' : 'bg-white shadow-md' }}">
    
    <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center">

        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
            {{-- Logo Text: Putih di Home, Hijau Gelap di halaman lain --}}
            <h1 id="nav-logo-text" class="font-serif text-2xl font-bold tracking-wide transition-colors duration-300 
                {{ request()->routeIs('home') ? 'text-white' : 'text-bedengan-dark' }}">
                Bedengan
            </h1>
        </a>

        <div id="nav-menu" class="hidden md:flex items-center gap-2 text-sm font-medium">
            
            {{-- HOME LINK --}}
            <a href="{{ route('home') }}" id="nav-link-home" class="nav-link px-5 py-2 rounded-full font-semibold transition-all duration-300 
                {{-- Jika Halaman Home --}}
                @if(request()->routeIs('home')) 
                    bg-white/20 text-white
                {{-- Jika Halaman Lain (status: inactive link) --}}
                @else
                    text-bedengan-dark hover:bg-bedengan-primary/10 hover:text-bedengan-primary
                @endif">
                Home
            </a>

            {{-- TICKET LINK --}}
            <a href="{{ route('booking.index') }}" class="nav-link px-5 py-2 rounded-full font-semibold transition-all duration-300 
                {{-- Jika Aktif --}}
                @if(request()->routeIs('ticket.*') || request()->routeIs('booking.*')) 
                    bg-bedengan-primary/10 text-bedengan-primary
                {{-- Jika Tidak Aktif --}}
                @else
                    {{-- Di Home: Putih, Di Lain: Gelap --}}
                    {{ request()->routeIs('home') ? 'text-white hover:bg-white/10' : 'text-bedengan-dark hover:bg-bedengan-primary/10 hover:text-bedengan-primary' }}
                @endif">
                Tickets
            </a>

            {{-- RENTAL LINK --}}
            <a href="{{ route('rent.index') }}" class="nav-link px-5 py-2 rounded-full font-semibold transition-all duration-300 
                @if(request()->routeIs('rent.*')) 
                    bg-bedengan-primary/10 text-bedengan-primary
                @else
                    {{ request()->routeIs('home') ? 'text-white hover:bg-white/10' : 'text-bedengan-dark hover:bg-bedengan-primary/10 hover:text-bedengan-primary' }}
                @endif">
                Equipment Rental
            </a>

            {{-- MOMENT LINK --}}
            <a href="{{ route('moment.index') }}" class="nav-link px-5 py-2 rounded-full font-semibold transition-all duration-300 
                @if(request()->routeIs('moment')) 
                    bg-bedengan-primary/10 text-bedengan-primary
                @else
                    {{ request()->routeIs('home') ? 'text-white hover:bg-white/10' : 'text-bedengan-dark hover:bg-bedengan-primary/10 hover:text-bedengan-primary' }}
                @endif">
                Moment 
            </a>

        </div>

        <div class="flex items-center gap-4">
            @auth
                <div class="relative group z-50">
                    <button id="nav-user-btn" class="flex items-center gap-1 px-5 py-2 rounded-full font-semibold transition-all duration-300 cursor-pointer
                        {{ request()->routeIs('home') ? 'text-white hover:bg-white/10' : 'text-bedengan-dark hover:bg-bedengan-primary/10' }}">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div class="absolute right-0 top-full pt-2 w-56 hidden group-hover:block hover:block">
                        <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-1">
                            
                            <a href="{{ route('booking.history') }}" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-bedengan-primary transition-colors flex items-center gap-2 border-b border-gray-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                Riwayat Tiket
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" id="btn-login" class="px-6 py-2 rounded-full text-sm font-semibold hover:shadow-lg transition-all
                    {{ request()->routeIs('home') ? 'bg-white text-bedengan-dark hover:bg-gray-100' : 'bg-bedengan-primary text-white hover:bg-green-600' }}">
                    Sign In
                </a>
            @endguest
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer class="bg-bedengan-dark text-white pt-16 pb-8 border-t-4 border-bedengan-primary">
    {{-- Footer Content Sama seperti sebelumnya --}}
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <div>
                <h2 class="font-serif text-3xl font-bold mb-4">Bedengan</h2>
                <p class="text-gray-300 leading-relaxed text-sm">The best nature destination in Greater Malang.</p>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4 text-bedengan-light">Navigation</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="{{ route('home') }}" class="hover:text-bedengan-primary transition">Home</a></li>
                    <li><a href="{{ route('booking.index') }}" class="hover:text-bedengan-primary transition">Tickets</a></li>
                    <li><a href="{{ route('rent.index') }}" class="hover:text-bedengan-primary transition">Equipment Rental</a></li>
                    <li><a href="{{ route('moment.index') }}" class="hover:text-bedengan-primary transition">Share Your Moments</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4 text-bedengan-light">Contact</h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-start gap-3"><span>Jl. Raya Bedengan, Malang</span></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 pt-8 text-center text-sm text-gray-500">
            © 2024 Bedengan Camping Ground.
        </div>
    </div>
</footer>


@if(request()->routeIs('home'))
<script>
    const navbar = document.getElementById('navbar');
    const navMenu = document.getElementById('nav-menu');
    const logoText = document.getElementById('nav-logo-text');
    const homeLink = document.getElementById('nav-link-home');
    const navUserBtn = document.getElementById('nav-user-btn'); // Dropdown user
    const btnLogin = document.getElementById('btn-login'); 
    
    function updateNavbar() {
        const isScrolled = window.scrollY > 10; // Trigger sedikit lebih cepat
        const links = navMenu.querySelectorAll('.nav-link');

        if (!isScrolled) {
            // --- STATE: TRANSPARENT (Top of Page) ---
            navbar.classList.remove('bg-white', 'shadow-md');
            navbar.classList.add('bg-transparent');
            
            // Logo -> Putih
            logoText.classList.remove('text-bedengan-dark');
            logoText.classList.add('text-white');

            // Home Link -> Active White Pill
            if(homeLink) {
                homeLink.classList.remove('bg-bedengan-primary/10', 'text-bedengan-primary');
                homeLink.classList.add('bg-white/20', 'text-white');
            }

            // Other Links -> Teks Putih
            links.forEach(link => {
                if(link !== homeLink) {
                    link.classList.remove('text-bedengan-dark', 'hover:bg-bedengan-primary/10', 'hover:text-bedengan-primary');
                    link.classList.add('text-white', 'hover:bg-white/10', 'hover:text-white');
                }
            });

            // User Dropdown Text
            if(navUserBtn) {
                navUserBtn.classList.remove('text-bedengan-dark', 'hover:bg-bedengan-primary/10');
                navUserBtn.classList.add('text-white', 'hover:bg-white/10');
            }

            // Tombol Login Guest (Putih teks hitam)
            if(btnLogin) {
                btnLogin.classList.remove('bg-bedengan-primary', 'text-white', 'hover:bg-green-600');
                btnLogin.classList.add('bg-white', 'text-bedengan-dark', 'hover:bg-gray-100');
            }

        } else {
            // --- STATE: SOLID (Scrolled Down) ---
            navbar.classList.remove('bg-transparent');
            navbar.classList.add('bg-white', 'shadow-md');
            
            // Logo -> Hijau Gelap
            logoText.classList.remove('text-white');
            logoText.classList.add('text-bedengan-dark');

            // Home Link -> Active Green Pill
            if(homeLink) {
                homeLink.classList.remove('bg-white/20', 'text-white');
                homeLink.classList.add('bg-bedengan-primary/10', 'text-bedengan-primary');
            }

            // Other Links -> Teks Hijau Gelap
            links.forEach(link => {
                if(link !== homeLink) {
                    link.classList.remove('text-white', 'hover:bg-white/10', 'hover:text-white');
                    link.classList.add('text-bedengan-dark', 'hover:bg-bedengan-primary/10', 'hover:text-bedengan-primary');
                }
            });

            // User Dropdown Text
            if(navUserBtn) {
                navUserBtn.classList.remove('text-white', 'hover:bg-white/10');
                navUserBtn.classList.add('text-bedengan-dark', 'hover:bg-bedengan-primary/10');
            }

            // Tombol Login Guest (Hijau teks putih agar kontras di bg putih)
            if(btnLogin) {
                btnLogin.classList.remove('bg-white', 'text-bedengan-dark', 'hover:bg-gray-100');
                btnLogin.classList.add('bg-bedengan-primary', 'text-white', 'hover:bg-green-600');
            }
        }
    }

    window.addEventListener('scroll', updateNavbar);
    // Jalankan sekali saat load untuk menangani refresh di posisi scroll bawah
    window.addEventListener('load', updateNavbar);
</script>
@endif

@stack('scripts')
</body>
</html>