@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
        <i class="fa-solid fa-trophy text-yellow-500"></i>
        Top Ranking Mahasiswa
    </h1>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="p-3">Rank</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">CPI</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($ranking as $m)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="p-3 text-center font-bold">
                            @if($no == 1)
                                <i class="fa-solid fa-crown text-yellow-500"></i>
                            @elseif($no == 2)
                                <i class="fa-solid fa-medal text-gray-400"></i>
                            @elseif($no == 3)
                                <i class="fa-solid fa-medal text-amber-600"></i>
                            @else
                                {{ $no }}
                            @endif
                        </td>
                        <td class="p-3">{{ $m->nama }}</td>
                        <td class="p-3 text-center font-semibold">
                            {{ number_format($m->cpi, 3) }}
                        </td>
                        <td class="p-3 text-center">
                            @if($no <= 3)
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold flex items-center justify-center gap-1">
                                    <i class="fa-solid fa-trophy"></i> Berprestasi
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @php $no++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
