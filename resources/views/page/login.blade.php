<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Bedengan Camping Ground</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bedengan: {
                            dark: '#0f3923',
                            primary: '#22c55e',
                            light: '#4ade80',
                            surface: '#f0fdf4', // Warna hijau sangat muda untuk lingkaran icon
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
            
            <a href="{{route('home')}}" class="text-white/80 hover:text-white text-sm font-medium flex items-center gap-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Home
            </a>
        </nav>
    </header>

    <main class="relative w-full min-h-screen flex items-center justify-center px-4 py-20">
        
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1510797215324-95aa89f43c33?q=80&w=1935&auto=format&fit=crop" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-bedengan-dark/60 backdrop-blur-sm"></div>
        </div>

        <div class="relative z-10 w-full max-w-[450px] bg-white rounded-[2rem] shadow-2xl p-8 md:p-10 animate-fade-in-up border border-white/20">
            
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-bedengan-surface rounded-full flex items-center justify-center text-bedengan-primary">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
            </div>

            <div class="text-center mb-8">
                <h2 class="font-serif text-3xl font-bold text-bedengan-dark">Welcome Back</h2>
                <p class="text-gray-500 mt-2 text-sm">Sign in to manage your bookings</p>
            </div>

            <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                @csrf
                <!-- pesan eror -->
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">{{ $errors->first() }}</span>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 ml-1">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required
                        class="form-input w-full px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 placeholder-gray-400 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5 ml-1">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required
                        class="form-input w-full px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 placeholder-gray-400 transition-all">
                </div>

                <button type="submit" 
                    class="w-full bg-bedengan-primary hover:bg-green-600 text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-green-500/30 transition-all transform hover:-translate-y-0.5 mt-2">
                    Sign In
                </button>

            </form>

            <div class="mt-8 text-center text-sm text-gray-500">
                Don't have an account? 
                <a href="{{route('register')}}" class="text-bedengan-primary font-semibold hover:underline">Sign up</a>
            </div>

        </div>

    </main>



</body>
</html>