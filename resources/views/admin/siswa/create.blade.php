<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            {{ __('Tambah Siswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.siswa.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="nama_lengkap" class="block font-medium text-sm text-coklat-muda">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                        class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm" required>
                                </div>
                                <div class="mb-4">
                                    <label for="nomor_telepon" class="block font-medium text-sm text-coklat-muda">Nomor Telepon (Opsional)</label>
                                    <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                        class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm">
                                </div>
                            </div>
                            <div>
                                <div class="mb-4">
                                    <label for="tanggal_bergabung" class="block font-medium text-sm text-coklat-muda">Tanggal Bergabung</label>
                                    <input type="date" name="tanggal_bergabung" id="tanggal_bergabung" value="{{ old('tanggal_bergabung', date('Y-m-d')) }}"
                                        class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm" required>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block font-medium text-sm text-coklat-muda">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm">
                                        <option value="aktif" @if(old('status') == 'aktif') selected @endif>Aktif</option>
                                        <option value="tidak aktif" @if(old('status') == 'tidak aktif') selected @endif>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
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