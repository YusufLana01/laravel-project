<nav class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 text-white flex justify-between items-center shadow">
    <div class="flex items-center gap-3">
        <i class="fa-solid fa-chart-line text-2xl"></i>
        <h1 class="font-bold text-xl">Sistem Penilaian CPI</h1>
    </div>

    <div class="flex items-center gap-4">
        <span class="text-sm opacity-90 hidden md:block">
            {{ auth()->user()->name ?? 'User' }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-lg text-sm flex items-center gap-2 transition">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</nav>
