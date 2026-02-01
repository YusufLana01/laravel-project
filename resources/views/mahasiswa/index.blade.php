@extends('layouts.app')

@section('title', 'Dashboard CPI Mahasiswa')

@section('content')
<div x-data="dashboard()">

<!-- HEADER CARD -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Mahasiswa</p>
            <p class="text-xl font-bold">{{ count($data) }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
        <div class="bg-green-100 text-green-600 p-3 rounded-full">
            <i class="fa-solid fa-trophy"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Mahasiswa Berprestasi</p>
            <p class="text-xl font-bold">Top 3</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4">
        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
            <i class="fa-solid fa-database"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Sumber Data</p>
            <p class="text-xl font-bold">UCI Dataset</p>
        </div>
    </div>
</div>

<!-- IMPORT CSV -->
<div class="bg-white p-5 rounded-lg shadow mb-6">
    <form action="/mahasiswa/import" method="POST" enctype="multipart/form-data"
          class="flex flex-col md:flex-row gap-4">
        @csrf
        <input type="file" name="csv" required class="border px-3 py-2 rounded w-full">
        <button class="bg-blue-600 text-white px-6 py-2 rounded flex items-center gap-2 hover:bg-blue-700">
            <i class="fa-solid fa-upload"></i> Import CSV UCI
        </button>
    </form>
    @if(session('success'))
        <p class="text-green-600 mt-3"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</p>
    @endif
</div>

<!-- TABLE -->
<div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-bold text-gray-700">Data Mahasiswa</h2>
    <button @click="modalAdd=true"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Tambah Mahasiswa
    </button>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
        <tr>
            <th class="p-3">Rank</th>
            <th class="p-3">Nama</th>
            <th class="p-3">G1</th>
            <th class="p-3">G2</th>
            <th class="p-3">G3</th>
            <th class="p-3">Absences</th>
            <th class="p-3">Studytime</th>
            <th class="p-3">CPI</th>
            <th class="p-3">Status</th>
            <th class="p-3">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @php $rank = 1; @endphp
        @foreach($data as $m)
            <tr class="border-t hover:bg-gray-50 transition">
                <td class="p-3 text-center font-bold">{{ $rank }}</td>
                <td class="p-3">{{ $m->nama }}</td>
                <td class="p-3 text-center">{{ $m->g1 }}</td>
                <td class="p-3 text-center">{{ $m->g2 }}</td>
                <td class="p-3 text-center">{{ $m->g3 }}</td>
                <td class="p-3 text-center">{{ $m->absences }}</td>
                <td class="p-3 text-center">{{ $m->studytime }}</td>
                <td class="p-3 text-center font-semibold">{{ number_format($m->cpi,3) }}</td>
                <td class="p-3 text-center">
                    @if($rank <= 3)
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                            <i class="fa-solid fa-trophy"></i> Berprestasi
                        </span>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="p-3 text-center space-x-3">
                    <button @click="editModal({{ $m->id }}, '{{ $m->nama }}', {{ $m->g1 }}, {{ $m->g2 }}, {{ $m->g3 }}, {{ $m->absences }}, {{ $m->studytime }})"
                            class="text-blue-600 hover:text-blue-800">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <a href="/mahasiswa/delete/{{ $m->id }}"
                       onclick="return confirm('Yakin hapus?')"
                       class="text-red-600 hover:text-red-800">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            @php $rank++; @endphp
        @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL TAMBAH -->
<div x-show="modalAdd" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded shadow max-w-lg w-full" @click.away="modalAdd=false">
        <h2 class="text-xl font-bold mb-4">➕ Tambah Mahasiswa</h2>
        <form action="/mahasiswa/store" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="nama" placeholder="Nama" class="w-full border p-2 rounded" required>
            <input type="number" name="g1" placeholder="G1" class="w-full border p-2 rounded" required>
            <input type="number" name="g2" placeholder="G2" class="w-full border p-2 rounded" required>
            <input type="number" name="g3" placeholder="G3" class="w-full border p-2 rounded" required>
            <input type="number" name="absences" placeholder="Absences" class="w-full border p-2 rounded" required>
            <input type="number" name="studytime" placeholder="Studytime" class="w-full border p-2 rounded" required>
            <div class="flex justify-end gap-2">
                <button type="button" @click="modalAdd=false" class="px-4 py-2 rounded bg-gray-300">Batal</button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div x-show="modalEdit" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded shadow max-w-lg w-full" @click.away="modalEdit=false">
        <h2 class="text-xl font-bold mb-4">✏️ Edit Mahasiswa</h2>
        <form :action="`/mahasiswa/update/${editData.id}`" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="nama" x-model="editData.nama" class="w-full border p-2 rounded" required>
            <input type="number" name="g1" x-model="editData.g1" class="w-full border p-2 rounded" required>
            <input type="number" name="g2" x-model="editData.g2" class="w-full border p-2 rounded" required>
            <input type="number" name="g3" x-model="editData.g3" class="w-full border p-2 rounded" required>
            <input type="number" name="absences" x-model="editData.absences" class="w-full border p-2 rounded" required>
            <input type="number" name="studytime" x-model="editData.studytime" class="w-full border p-2 rounded" required>
            <div class="flex justify-end gap-2">
                <button type="button" @click="modalEdit=false" class="px-4 py-2 rounded bg-gray-300">Batal</button>
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    function dashboard() {
        return {
            modalAdd: false,
            modalEdit: false,
            editData: {},
            editModal(id, nama, g1, g2, g3, absences, studytime) {
                this.editData = { id, nama, g1, g2, g3, absences, studytime };
                this.modalEdit = true;
            }
        }
    }
</script>
@endpush
