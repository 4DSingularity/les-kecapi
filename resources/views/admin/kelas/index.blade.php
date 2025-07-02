<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            {{ __('Kelola Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.kelas.create') }}" class="inline-flex items-center px-4 py-2 bg-coklat-tua border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-coklat-muda focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-coklat-tua transition ease-in-out duration-150">
                    + Tambah Kelas Baru
                </a>
            </div>

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
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3">Nama Kelas</th>
                                    <th class="px-6 py-3">Biaya per Pertemuan</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftarKelas as $kela)
                                    <tr class="bg-white border-b hover:bg-krem/50">
                                        <td class="px-6 py-4">{{ $daftarKelas->firstItem() + $loop->index }}</td>
                                        <td class="px-6 py-4 font-medium text-coklat-tua whitespace-nowrap">{{ $kela->nama_kelas }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($kela->biaya_per_pertemuan, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 space-x-4">
                                            <a href="{{ route('admin.kelas.edit', $kela->id) }}" class="font-medium text-terakota hover:underline">Edit</a>
                                            <form action="{{ route('admin.kelas.destroy', $kela->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-6 text-gray-500">Belum ada data kelas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $daftarKelas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>