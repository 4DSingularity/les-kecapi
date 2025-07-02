<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            {{ __('Tambah Kelas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.kelas.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_kelas" class="block font-medium text-sm text-coklat-muda">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}"
                                class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="biaya_per_pertemuan" class="block font-medium text-sm text-coklat-muda">Biaya per Pertemuan (Rp)</label>
                            <input type="number" name="biaya_per_pertemuan" id="biaya_per_pertemuan" value="{{ old('biaya_per_pertemuan') }}"
                                class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="block font-medium text-sm text-coklat-muda">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.kelas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-terakota border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-terakota-hover">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>