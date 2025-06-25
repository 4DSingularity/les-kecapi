<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('siswa.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Siswa</a>
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-4">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
                    <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Kelas</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $data)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-4 py-2">{{ $data->nama }}</td>
                                <td class="px-4 py-2">{{ $data->user->email ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $data->kelas->nama_kelas ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('siswa.edit', $data) }}" class="text-blue-500">Edit</a>
                                    <form action="{{ route('siswa.destroy', $data) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($siswas->isEmpty())
                            <tr><td colspan="4" class="text-center py-4 text-gray-500">Belum ada data.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
