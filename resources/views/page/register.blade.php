<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Register - Bedengan Camping Ground')</title>
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
        .form-input:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-700">

    <header class="fixed top-0 left-0 right-0 z-50 py-4">
        <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="index.html" class="flex items-center gap-2 group">
                <h1 class="font-serif text-2xl font-bold text-white tracking-wide">
                    Bedengan
                </h1>
            </a>
            
            <a href="{{route('login')}}" class="text-white/80 hover:text-white text-sm font-medium flex items-center gap-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Home
            </a>
        </nav>
    </header>

    <main class="relative w-full min-h-screen flex items-center justify-center px-4 py-24">
        
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1510797215324-95aa89f43c33?q=80&w=1935&auto=format&fit=crop" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-bedengan-dark/60 backdrop-blur-sm"></div>
        </div>

        <div class="relative z-10 w-full max-w-[500px] bg-white rounded-[2rem] shadow-2xl p-8 md:p-10 animate-fade-in-up border border-white/20">
            
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-bedengan-surface rounded-full flex items-center justify-center text-bedengan-primary">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                </div>
            </div>

 <div class="text-center mb-8">
                <h2 class="font-serif text-3xl font-bold text-bedengan-dark">Create Account</h2>
                <p class="text-gray-500 mt-2 text-sm">Join us and start your adventure</p>
            </div>

            {{-- TAMPILKAN ERROR DARI CONTROLLER --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- PERBAIKAN FORM --}}
            {{-- Pastikan route-nya mengarah ke route untuk PROSES register (POST), bukan halaman register (GET) --}}
            <form action="{{ route('register.process') }}" method="POST" class="space-y-4">
                @csrf  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 ml-1">Full Name</label>
                    {{-- TAMBAHKAN name="name" --}}
                    <input type="text" name="name" placeholder="Enter your full name" required value="{{ old('name') }}"
                        class="form-input w-full px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 placeholder-gray-400 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 ml-1">Email</label>
                    {{-- TAMBAHKAN name="email" --}}
                    <input type="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}"
                        class="form-input w-full px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 placeholder-gray-400 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 ml-1">Password</label>
                    {{-- TAMBAHKAN name="password" --}}
                    <input type="password" name="password" id="password" placeholder="Create a password" required
                        class="form-input w-full px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 placeholder-gray-400 transition-all focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 ml-1">Confirm Password</label>
                    {{-- Confirm password tidak perlu name, karena divalidasi JS di frontend saja atau gunakan 'password_confirmation' jika pakai validasi Laravel 'confirmed' --}}
                    <input type="password" id="confirm-password" placeholder="Repeat your password" required
                        class="form-input w-full px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 placeholder-gray-400 transition-all focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    
                    <p id="error-msg" class="hidden text-red-500 text-sm mt-2 ml-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Password tidak cocok!
                    </p>
                </div>

                <button type="submit" 
                    class="w-full bg-bedengan-primary hover:bg-green-600 text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-green-500/30 transition-all transform hover:-translate-y-0.5 mt-4">
                    Sign Up
                </button>

            </form>

            <div class="mt-8 text-center text-sm text-gray-500">
                Already have an account? 
                <a href="{{route('login')}}" class="text-bedengan-primary font-semibold hover:underline">Sign In</a>
            </div>

        </div>

    </main>

    <script>
        const form = document.querySelector('form');
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirm-password');
        const errorMsg = document.getElementById('error-msg');

        form.addEventListener('submit', function(e) {
            // cek apakah password sama
            if (passwordInput.value !== confirmInput.value) {
                // back
                e.preventDefault(); 
                
                // pesan eror
                errorMsg.classList.remove('hidden');
                
                // border merah 
                confirmInput.classList.add('border-red-500', 'ring-red-500');
                confirmInput.classList.remove('border-gray-300');
            } else {
                // sembunyiin eror
                errorMsg.classList.add('hidden');
            }
        });

        // reset eror
        confirmInput.addEventListener('input', function() {
            errorMsg.classList.add('hidden');
            confirmInput.classList.remove('border-red-500', 'ring-red-500');
            confirmInput.classList.add('border-gray-300');
        });
    </script>

</body>
</html>