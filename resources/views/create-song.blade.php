<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lagu Baru - Laravel Music</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-900 text-white min-h-screen flex items-center justify-center p-6">

    <div class="bg-slate-800 p-8 rounded-xl shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-bold mb-6 text-emerald-400 text-center">➕ Tambah Lagu Baru</h1>

        <!-- Tampilkan Error Validasi jika ada -->
        @if ($errors->any())
        <div class="bg-red-500/20 border border-red-500 text-red-300 p-3 rounded-lg mb-4 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="/songs" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Judul Lagu</label>
                <input type="text" name="title" required placeholder="Contoh: Lofi Study Beats"
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 focus:outline-none focus:border-emerald-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Nama Artis / Channel</label>
                <input type="text" name="artist" required placeholder="Contoh: Lofi Girl"
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 focus:outline-none focus:border-emerald-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2">YouTube Video ID</label>
                <input type="text" name="youtube_id" required placeholder="Contoh: jfKfPfyJRdk"
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 focus:outline-none focus:border-emerald-500">
                <p class="text-xs text-slate-400 mt-1">*Ambil dari URL YouTube (misal: youtube.com/watch?v=<strong>jfKfPfyJRdk</strong>)</p>
            </div>

            <div class="flex justify-between items-center">
                <a href="/" class="text-sm text-slate-400 hover:text-white transition">Kembali</a>
                <button type="submit" class="px-6 py-2 bg-emerald-500 hover:bg-emerald-400 font-bold rounded-lg transition text-slate-900">
                    Simpan Lagu
                </button>
            </div>
        </form>
    </div>

</body>

</html>