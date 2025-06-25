<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Materi Pembelajaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('materi.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">
                + Tambah Materi
            </a>
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-4">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
                    <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">Judul</th>
                            <th class="px-4 py-2">Kelas</th>
                            <th class="px-4 py-2">File</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materi as $item)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-4 py-2">{{ $item->judul }}</td>
                                <td class="px-4 py-2">{{ $item->kelas->nama ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    @if ($item->file)
                                        <a href="{{ asset('storage/' . $item->file) }}" class="text-blue-500" target="_blank">Lihat File</a>
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada file</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('materi.edit', $item) }}" class="text-blue-500">Edit</a>
                                    <form action="{{ route('materi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
