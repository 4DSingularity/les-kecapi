<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
                {{ __('Dashboard') }}
            </h2>
            {{-- Tombol aksi utama dipindah ke header agar lebih mudah diakses --}}
            <a href="{{ route('admin.pertemuan.create') }}" class="inline-flex items-center px-4 py-2 bg-terakota border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-terakota-hover focus:outline-none focus:ring-2 focus:ring-terakota focus:ring-offset-2 transition ease-in-out duration-150">
                + Mulai Pertemuan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Kartu Statistik Utama dengan Ikon -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                {{-- Siswa Aktif --}}
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between border-l-4 border-terakota">
                    <div>
                        <h3 class="text-sm font-medium text-coklat-muda uppercase tracking-wider">Siswa Aktif</h3>
                        <p class="mt-1 text-3xl font-semibold text-coklat-tua">{{ $jumlahSiswaAktif }}</p>
                    </div>
                    <div class="bg-terakota/10 p-3 rounded-full">
                        <svg class="h-6 w-6 text-terakota" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                    </div>
                </div>
                {{-- Total Kelas --}}
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between border-l-4 border-terakota">
                    <div>
                        <h3 class="text-sm font-medium text-coklat-muda uppercase tracking-wider">Total Kelas</h3>
                        <p class="mt-1 text-3xl font-semibold text-coklat-tua">{{ $jumlahKelas }}</p>
                    </div>
                     <div class="bg-terakota/10 p-3 rounded-full">
                        <svg class="h-6 w-6 text-terakota" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125v-1.5c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h-1.5m1.5 0h1.5m-1.5 0V8.25m17.25 0V8.25m0 11.25V8.25m0 0a2.25 2.25 0 00-2.25-2.25h-1.5a2.25 2.25 0 00-2.25 2.25m-7.5 0a2.25 2.25 0 01-2.25-2.25h-1.5a2.25 2.25 0 01-2.25 2.25m7.5 0h-7.5" /></svg>
                    </div>
                </div>
                 {{-- Pertemuan Bulan Ini --}}
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between border-l-4 border-terakota">
                    <div>
                        <h3 class="text-sm font-medium text-coklat-muda uppercase tracking-wider">Pertemuan Bulan Ini</h3>
                        <p class="mt-1 text-3xl font-semibold text-coklat-tua">{{ $pertemuanBulanIni }}</p>
                    </div>
                    <div class="bg-terakota/10 p-3 rounded-full">
                        <svg class="h-6 w-6 text-terakota" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M12 15.75h.008v.008H12v-.008z" /></svg>
                    </div>
                </div>
            </div>

            <!-- Kartu Keuangan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-green-50 border-green-200 border p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-medium text-green-800">Total Pemasukan Bulan Ini</h3>
                    <p class="mt-1 text-3xl font-semibold text-green-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>
                 <div class="bg-red-50 border-red-200 border p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-medium text-red-800">Total Tunggakan Bulan Ini</h3>
                    <p class="mt-1 text-3xl font-semibold text-red-700">Rp {{ number_format($totalTunggakan, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Tabel Riwayat Pertemuan Terakhir -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-coklat-tua mb-4">Riwayat Pertemuan Terakhir</h3>
                    <div class="table-responsive">
                        <table class="w-full text-sm text-left text-coklat-muda">
                            <thead class="text-xs text-coklat-tua uppercase bg-krem">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Kelas</th>
                                    <th class="px-6 py-3">Topik</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pertemuanTerakhir as $pertemuan)
                                    <tr class="bg-white border-b hover:bg-krem/50">
                                        <td class="px-6 py-4">{{ $pertemuan->tanggal_pertemuan->format('d M Y') }}</td>
                                        <td class="px-6 py-4 font-medium text-coklat-tua">{{ $pertemuan->kelas->nama_kelas }}</td>
                                        <td class="px-6 py-4">{{ $pertemuan->topik_hari_ini ?? '-' }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('admin.absensi.edit', $pertemuan->id) }}" class="font-medium text-terakota hover:underline">Lihat/Edit Absensi</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-6 text-gray-500">Belum ada riwayat pertemuan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>