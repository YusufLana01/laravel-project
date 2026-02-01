@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
        <i class="fa-solid fa-chart-column text-blue-600"></i>
        Analisis CPI Mahasiswa
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-5 rounded shadow">
            <p class="text-sm text-gray-500 flex items-center gap-2">
                <i class="fa-solid fa-chart-simple text-blue-500"></i>
                Rata-rata CPI
            </p>
            <p class="text-2xl font-bold text-blue-600">{{ number_format($avgCpi, 3) }}</p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <p class="text-sm text-gray-500 flex items-center gap-2">
                <i class="fa-solid fa-arrow-trend-up text-green-500"></i>
                CPI Tertinggi
            </p>
            <p class="text-2xl font-bold text-green-600">{{ number_format($maxCpi, 3) }}</p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <p class="text-sm text-gray-500 flex items-center gap-2">
                <i class="fa-solid fa-arrow-trend-down text-red-500"></i>
                CPI Terendah
            </p>
            <p class="text-2xl font-bold text-red-600">{{ number_format($minCpi, 3) }}</p>
        </div>
    </div>

    <div class="bg-white rounded shadow p-5">
        <h2 class="font-semibold mb-3 flex items-center gap-2">
            <i class="fa-solid fa-circle-info text-indigo-500"></i>
            Ringkasan
        </h2>
        <p class="text-sm text-gray-600">
            Halaman ini menampilkan ringkasan hasil perhitungan CPI mahasiswa, meliputi nilai rata-rata,
            nilai tertinggi, dan nilai terendah sebagai bahan evaluasi kinerja akademik.
        </p>
    </div>

</div>
@endsection
