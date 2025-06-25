<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Jadwal
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('jadwal.store') }}">
                @csrf

                <!-- Hari -->
                <div class="mb-4">
                    <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                    <select name="hari" id="hari" class="form-select mt-1 block w-full rounded-md shadow-sm">
                        <option value="">-- Pilih Hari --</option>
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                            <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jam Mulai -->
                <div class="mb-4">
                    <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="jam_mulai"
                           value="{{ old('jam_mulai') }}"
                           class="form-input mt-1 block w-full rounded-md shadow-sm">
                </div>

                <!-- Jam Selesai -->
                <div class="mb-4">
                    <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai"
                           value="{{ old('jam_selesai') }}"
                           class="form-input mt-1 block w-full rounded-md shadow-sm">
                </div>

                <!-- Pilih Kelas -->
                <div class="mb-4">
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-select mt-1 block w-full rounded-md shadow-sm">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}" {{ old('kelas_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('jadwal.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
