<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">➕ Tambah Data Mahasiswa</h2>

    <form action="/mahasiswa/store" method="POST" class="space-y-4">
        @csrf

        <input type="text" name="nama" placeholder="Nama"
            class="w-full border p-2 rounded" required>

        <input type="number" name="g1" placeholder="G1"
            class="w-full border p-2 rounded" required>

        <input type="number" name="g2" placeholder="G2"
            class="w-full border p-2 rounded" required>

        <input type="number" name="g3" placeholder="G3"
            class="w-full border p-2 rounded" required>

        <input type="number" name="absences" placeholder="Absences"
            class="w-full border p-2 rounded" required>

        <input type="number" name="studytime" placeholder="Studytime"
            class="w-full border p-2 rounded" required>

        <div class="flex justify-between">
            <a href="/mahasiswa" class="text-gray-600">← Kembali</a>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>

</body>
</html>
