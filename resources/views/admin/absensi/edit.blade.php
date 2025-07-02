<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            Edit Absensi Kelas: {{ $pertemuan->kelas->nama_kelas }}
        </h2>
        <p class="text-sm text-coklat-muda mt-1">
            Tanggal: {{ $pertemuan->tanggal_pertemuan->format('d F Y') }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('admin.absensi.update', $pertemuan->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-coklat-tua">Daftar Siswa Aktif</h3>
                            <p class="mt-1 text-sm text-coklat-muda">
                                Ubah centang pada siswa yang hadir di pertemuan ini.
                            </p>
                        </div>

                        <div class="space-y-3">
                            @foreach ($daftarSiswa as $siswa)
                                <label for="siswa_{{ $siswa->id }}" class="flex items-center p-4 border rounded-lg cursor-pointer transition-all duration-200 has-[:checked]:bg-terakota/10 has-[:checked]:border-terakota hover:border-terakota/50">
                                    <input type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}" id="siswa_{{ $siswa->id }}"
                                           class="h-5 w-5 rounded border-gray-300 text-terakota focus:ring-terakota"
                                           {{-- [UBAHAN] Cek apakah siswa ini ada di daftar hadir --}}
                                           @if(in_array($siswa->id, $siswaHadirIds)) checked @endif>
                                    
                                    <span class="ms-3 font-medium text-coklat-tua">{{ $siswa->nama_lengkap }}</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t pt-6">
                            <a href="{{ route('admin.pertemuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-terakota border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-terakota-hover">
                                Update Absensi
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>