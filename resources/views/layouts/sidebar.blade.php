<aside class="w-64 bg-white min-h-screen shadow-lg">
    <div class="p-5 border-b">
        <h2 class="font-bold text-gray-700 uppercase text-sm">Menu Utama</h2>
    </div>

    <ul class="p-4 space-y-2 text-sm">

        <!-- Data Mahasiswa -->
        <li>
            <a href="/mahasiswa"
               class="flex items-center gap-3 px-4 py-2 rounded w-full
               {{ request()->is('mahasiswa*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="fa-solid fa-table"></i>
                Data Mahasiswa
            </a>
        </li>

        <!-- Analisis CPI -->
        <li>
            <a href="/dashboard/analisis"
               class="flex items-center gap-3 px-4 py-2 rounded w-full
               {{ request()->is('dashboard/analisis') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="fa-solid fa-chart-pie"></i>
                Analisis CPI
            </a>
        </li>

        <!-- Top Ranking -->
        <li>
            <a href="/dashboard/ranking"
               class="flex items-center gap-3 px-4 py-2 rounded w-full
               {{ request()->is('dashboard/ranking') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                <i class="fa-solid fa-trophy"></i>
                Top Ranking
            </a>
        </li>

    </ul>
</aside>
