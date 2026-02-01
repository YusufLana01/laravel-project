<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">✏️ Edit Data Mahasiswa</h2>

    <form action="/mahasiswa/update/{{ $m->id }}" method="POST" class="space-y-4">
        @csrf

        <input type="text" name="nama" value="{{ $m->nama }}"
            class="w-full border p-2 rounded" required>

        <input type="number" name="g1" value="{{ $m->g1 }}"
            class="w-full border p-2 rounded" required>

        <input type="number" name="g2" value="{{ $m->g2 }}"
            class="w-full border p-2 rounded" required>

        <input type="number" name="g3" value="{{ $m->g3 }}"
            class="w-full border p-2 rounded" required>

        <input type="number" name="absences" value="{{ $m->absences }}"
            class="w-full border p-2 rounded" required>

        <input type="number" name="studytime" value="{{ $m->studytime }}"
            class="w-full border p-2 rounded" required>

        <div class="flex justify-between">
            <a href="/mahasiswa" class="text-gray-600">← Kembali</a>
            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>
    </form>
</div>

</body>
</html>
