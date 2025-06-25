<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kelas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert jika ada session success -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Alert jika ada error validasi -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('kelas.update', $kelas) }}">
                @csrf
                @method('PUT')
                <!-- Input Nama Kelas -->
                <div class="mb-4">
                    <label for="nama_kelas" class="block font-medium text-sm text-gray-700">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas"
                        value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                </div>

                <!-- Input Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" rows="4">{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('kelas.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
