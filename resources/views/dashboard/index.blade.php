@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <form action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Start Date</label>
                <input type="date" name="start_date" value="{{ $startDate }}" 
                    class="px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-bedengan-primary text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">End Date</label>
                <input type="date" name="end_date" value="{{ $endDate }}" 
                    class="px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-bedengan-primary text-sm">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-bedengan-primary hover:bg-green-600 text-white px-6 py-2 rounded-lg text-sm font-bold transition-all">
                    Filter
                </button>
                <a href="{{ route('dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2 rounded-lg text-sm font-bold transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>
    
    {{-- Statistik Bisnis Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center group hover:border-blue-500 transition-all">
            <div class="p-4 bg-blue-50 rounded-xl text-blue-600 mr-4 group-hover:bg-blue-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Tiket Terjual</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($ticketsSold) }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center group hover:border-orange-500 transition-all">
            <div class="p-4 bg-orange-50 rounded-xl text-orange-600 mr-4 group-hover:bg-orange-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Rental</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalRentals) }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center group hover:border-green-500 transition-all">
            <div class="p-4 bg-green-50 rounded-xl text-green-600 mr-4 group-hover:bg-green-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Revenue</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center group hover:border-purple-500 transition-all">
            <div class="p-4 bg-purple-50 rounded-xl text-purple-600 mr-4 group-hover:bg-purple-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Akun</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalUser }}</h3>
            </div>
        </div>

    </div>
</div>
@endsection