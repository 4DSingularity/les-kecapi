<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Kelas -->
                <a href="{{ route('kelas.index') }}" class="block p-6 bg-blue-100 dark:bg-blue-900 rounded-lg shadow hover:bg-blue-200 dark:hover:bg-blue-800 transition">
                    <h3 class="text-lg font-bold text-blue-800 dark:text-blue-200">📚 Total Kelas</h3>
                    <p class="text-2xl mt-2">{{ $totalKelas }}</p>
                </a>

                <!-- Siswa -->
                <a href="{{ route('siswa.index') }}" class="block p-6 bg-purple-100 dark:bg-purple-900 rounded-lg shadow hover:bg-purple-200 dark:hover:bg-purple-800 transition">
                    <h3 class="text-lg font-bold text-purple-800 dark:text-purple-200">👩‍🎓 Total Siswa</h3>
                    <p class="text-2xl mt-2">{{ $totalSiswa }}</p>
                </a>

                <!-- Jadwal -->
                <a href="{{ route('jadwal.index') }}" class="block p-6 bg-green-100 dark:bg-green-900 rounded-lg shadow hover:bg-green-200 dark:hover:bg-green-800 transition">
                    <h3 class="text-lg font-bold text-green-800 dark:text-green-200">🗓️ Total Jadwal</h3>
                    <p class="text-2xl mt-2">{{ $totalJadwal }}</p>
                </a>

                <!-- Materi -->
                <a href="{{ route('materi.index') }}" class="block p-6 bg-yellow-100 dark:bg-yellow-900 rounded-lg shadow hover:bg-yellow-200 dark:hover:bg-yellow-800 transition">
                    <h3 class="text-lg font-bold text-yellow-800 dark:text-yellow-200">📁 Total Materi</h3>
                    <p class="text-2xl mt-2">{{ $totalMateri }}</p>
                </a>

                <!-- Pembayaran -->
                <a href="{{ route('pembayaran.index') }}" class="block p-6 bg-red-100 dark:bg-red-900 rounded-lg shadow hover:bg-red-200 dark:hover:bg-red-800 transition">
                    <h3 class="text-lg font-bold text-red-800 dark:text-red-200">💳 Total Pembayaran</h3>
                    <p class="text-2xl mt-2">{{ $totalPembayaran }}</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
