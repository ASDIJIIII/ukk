@extends('layouts.dashboard')

@section('title', 'Ringkasan Statistik')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase">Total Pengguna</p>
            <p class="text-3xl font-bold text-gray-800">1,245</p>
        </div>
        <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase">Pendapatan</p>
            <p class="text-3xl font-bold text-gray-800">Rp 45.000.000</p>
        </div>
        <div class="p-3 bg-green-100 text-green-600 rounded-full">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-20c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z" /></svg>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase">Produk Terjual</p>
            <p class="text-3xl font-bold text-gray-800">340 Pcs</p>
        </div>
        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
        </div>
    </div>
</div>

<!-- Placeholder untuk Tabel/Grafik -->
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <h3 class="text-lg font-medium text-gray-800 mb-4">Aktivitas Terbaru</h3>
    <div class="h-48 border-2 border-dashed border-gray-200 rounded flex items-center justify-center text-gray-400">
        [Konten atau tabel data letakkan di sini]
    </div>
</div>
@endsection
