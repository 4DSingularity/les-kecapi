<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            {{ __('Mulai Pertemuan & Absensi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Menampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded" role="alert">
                            <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.pertemuan.store') }}">
                        @csrf
                        
                        {{-- Input Tanggal Pertemuan --}}
                        <div class="mb-4">
                            <label for="tanggal_pertemuan" class="block font-medium text-sm text-coklat-muda">Tanggal Pertemuan</label>
                            <input type="date" name="tanggal_pertemuan" id="tanggal_pertemuan" value="{{ old('tanggal_pertemuan', date('Y-m-d')) }}"
                                class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm" required>
                        </div>

                        {{-- Input Pilih Kelas --}}
                        <div class="mb-4">
                            <label for="kelas_id" class="block font-medium text-sm text-coklat-muda">Pilih Kelas</label>
                            <select name="kelas_id" id="kelas_id" required
                                class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm">
                                <option value="" disabled selected>-- Pilih salah satu kelas --</option>
                                @forelse($daftarKelas as $kelas)
                                    <option value="{{ $kelas->id }}" @if(old('kelas_id') == $kelas->id) selected @endif>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @empty
                                    <option value="" disabled>Belum ada data kelas. Silakan tambah dulu.</option>
                                @endforelse
                            </select>
                        </div>
                        
                        {{-- Input Topik Pembelajaran --}}
                        <div class="mb-4">
                            <label for="topik_hari_ini" class="block font-medium text-sm text-coklat-muda">Topik Pembelajaran (Opsional)</label>
                            <textarea name="topik_hari_ini" id="topik_hari_ini" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm">{{ old('topik_hari_ini') }}</textarea>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-6 border-t pt-6">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-terakota border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-terakota-hover">
                                Lanjutkan ke Halaman Absensi →
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>