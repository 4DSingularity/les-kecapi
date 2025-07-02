<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Mengambil nama kelas dari relasi --}}
            Absensi Kelas: {{ $pertemuan->kelas->nama_kelas }}
        </h2>
        {{-- Menampilkan tanggal dengan format yang mudah dibaca --}}
        <p class="text-sm text-gray-500 mt-1">
            Tanggal: {{ $pertemuan->tanggal_pertemuan->format('d F Y') }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('admin.absensi.store', $pertemuan->id) }}">
                        @csrf
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900">Daftar Siswa Aktif</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Beri centang pada siswa yang hadir di pertemuan ini. Secara default, semua siswa dianggap hadir.
                            </p>
                        </div>

                        {{-- Cek jika tidak ada siswa sama sekali --}}
                        @if($daftarSiswa->isEmpty())
                            <div class="text-center py-10">
                                <p class="text-gray-500">Tidak ada siswa aktif yang terdaftar di sistem.</p>
                                <a href="{{ route('admin.siswa.create') }}" class="mt-2 text-sm text-blue-600 hover:underline">Tambah Siswa Baru</a>
                            </div>
                        @else
                            {{-- Daftar Siswa untuk Absensi --}}
                            <div class="space-y-4">
                                @foreach ($daftarSiswa as $siswa)
                                    <label for="siswa_{{ $siswa->id }}" class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}" id="siswa_{{ $siswa->id }}"
                                               class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" checked>
                                        <span class="ms-3 font-medium text-gray-700">{{ $siswa->nama_lengkap }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-6 border-t pt-6">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                                Simpan Absensi
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>