<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            {{ __('Kelola Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.siswa.create') }}" class="inline-flex items-center px-4 py-2 bg-coklat-tua border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-coklat-muda focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-coklat-tua transition ease-in-out duration-150">
                    + Tambah Siswa Baru
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
                                    <th class="px-6 py-3">Nama Lengkap</th>
                                    <th class="px-6 py-3">No. Telepon</th>
                                    <th class="px-6 py-3">Tanggal Bergabung</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftarSiswa as $siswa)
                                    <tr class="bg-white border-b hover:bg-krem/50">
                                        <td class="px-6 py-4">{{ $daftarSiswa->firstItem() + $loop->index }}</td>
                                        <td class="px-6 py-4 font-medium text-coklat-tua whitespace-nowrap">{{ $siswa->nama_lengkap }}</td>
                                        <td class="px-6 py-4">{{ $siswa->nomor_telepon ?? '-' }}</td>
                                        <td class="px-6 py-4">{{ $siswa->tanggal_bergabung->format('d F Y') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $siswa->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($siswa->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 space-x-4">
                                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="font-medium text-terakota hover:underline">Edit</a>
                                            <a href="{{ route('admin.siswa.riwayat', $siswa->id) }}" class="font-medium text-green-600 hover:underline">Riwayat</a>
                                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-6 text-gray-500">Belum ada data siswa.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $daftarSiswa->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>