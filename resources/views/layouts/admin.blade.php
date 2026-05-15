<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Buper Bedengan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 font-sans antialiased flex h-screen overflow-hidden">
    <!-- sidebar -->
    <aside class="w-64 bg-bedengan-dark text-white flex-shrink-0 hidden md:flex flex-col shadow-xl z-20">
        <div class="h-20 flex items-center justify-center border-b border-white/10 bg-black/10">
            <h1 class="text-2xl font-bold italic tracking-wider font-serif">
                Buper<span class="text-bedengan-light">Admin</span>
            </h1>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
            
            <a href="{{ route('dashboard') }}" 
                class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 font-semibold {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white shadow-inner border-l-4 border-bedengan-light' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            <a href="{{ route('users.index') }}" 
                class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 font-semibold {{ request()->routeIs('users.*') ? 'bg-white/10 text-white shadow-inner border-l-4 border-bedengan-light' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Pengguna
            </a>

            <a href="{{ route('admin.bookings.index') }}" 
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 font-semibold {{ request()->routeIs('admin.bookings.*') ? 'bg-white/10 text-white shadow-inner border-l-4 border-bedengan-light' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                Manajemen Tiket
            </a>

            <a href="{{ route('admin.rentals.index') }}" 
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 font-semibold {{ request()->routeIs('admin.rentals.*') ? 'bg-white/10 text-white shadow-inner border-l-4 border-bedengan-light' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4l8-4"></path></svg>
                Manajemen Rental
            </a>

            <a href="{{ route('admin.equipment.index') }}" 
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 font-semibold {{ request()->routeIs('admin.equipment.*') ? 'bg-white/10 text-white shadow-inner border-l-4 border-bedengan-light' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path></svg>
                Kelola Equipment
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 bg-black/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors shadow-md group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Aplikasi
                </button>
            </form>
        </div>
    </aside>

    <!-- isi/main -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50">
        
        <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10 sticky top-0">
            <div>
                <!-- header halaman -->
                <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Overview')</h2>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-bedengan-primary font-semibold">{{ Auth::user()->role->name }}</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0f3923&color=fff&bold=true" class="w-10 h-10 rounded-full border-2 border-bedengan-primary p-0.5 shadow-sm">
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </div>

    </main>

    {{-- Script Alert Global --}}
    <script>
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', showConfirmButton: false, timer: 2000 });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}' });
        @endif
    </script>
</body>
</html>