<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tombol Aksi Utama -->
            <div class="mb-6">
                <a href="{{ route('admin.pertemuan.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg">
                    + Mulai Pertemuan & Absensi
                </a>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium">Siswa Aktif</h3>
                        <p class="mt-1 text-3xl font-semibold">{{ $jumlahSiswaAktif }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium">Total Kelas</h3>
                        <p class="mt-1 text-3xl font-semibold">{{ $jumlahKelas }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium">Pertemuan Bulan Ini</h3>
                        <p class="mt-1 text-3xl font-semibold">{{ $pertemuanBulanIni }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>