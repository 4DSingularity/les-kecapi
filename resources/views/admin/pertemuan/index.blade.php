<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            {{ __('Riwayat Pertemuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="table-responsive">
                        <table class="w-full text-sm text-left text-coklat-muda">
                            <thead class="text-xs text-coklat-tua uppercase bg-krem">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Kelas</th>
                                    <th class="px-6 py-3">Topik</th>
                                    <th class="px-6 py-3 text-center">Jumlah Hadir</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftarPertemuan as $pertemuan)
                                    <tr class="bg-white border-b hover:bg-krem/50">
                                        <td class="px-6 py-4">{{ $pertemuan->tanggal_pertemuan->format('d M Y') }}</td>
                                        <td class="px-6 py-4 font-medium text-coklat-tua">{{ $pertemuan->kelas->nama_kelas }}</td>
                                        <td class="px-6 py-4">{{ $pertemuan->topik_hari_ini ?? '-' }}</td>
                                        <td class="px-6 py-4 text-center">{{ $pertemuan->siswa_yang_hadir_count }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('admin.absensi.edit', $pertemuan->id) }}" class="font-medium text-terakota hover:underline">Lihat/Edit Absensi</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-6 text-gray-500">Belum ada riwayat pertemuan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $daftarPertemuan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>