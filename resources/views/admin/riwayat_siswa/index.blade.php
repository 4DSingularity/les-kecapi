<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            Riwayat Tagihan: {{ $siswa->nama_lengkap }}
        </h2>
        <a href="{{ route('admin.siswa.index') }}" class="text-sm text-terakota hover:underline mt-1">← Kembali ke Daftar Siswa</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Kartu Rekapitulasi Total -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-coklat-muda">Total Semua Tagihan</h3>
                    <p class="mt-1 text-2xl font-semibold text-coklat-tua">Rp {{ number_format($totalSemuaTagihan) }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-coklat-muda">Total Telah Dibayar</h3>
                    <p class="mt-1 text-2xl font-semibold text-green-600">Rp {{ number_format($totalSemuaPembayaran) }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-coklat-muda">Total Tunggakan</h3>
                    <p class="mt-1 text-2xl font-semibold text-red-600">Rp {{ number_format($totalTunggakan) }}</p>
                </div>
            </div>

            <!-- Daftar Riwayat Tagihan per Bulan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-coklat-tua mb-4">Rincian per Bulan</h3>
                    <div class="space-y-4">
                        @forelse($siswa->tagihan as $tagihan)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-bold text-coklat-tua">
                                            Tagihan Bulan {{ \Carbon\Carbon::create()->month($tagihan->bulan)->isoFormat('MMMM YYYY') }}
                                        </h4>
                                        <p class="text-sm text-coklat-muda">
                                            Total: Rp {{ number_format($tagihan->total_tagihan) }} | Dibayar: Rp {{ number_format($tagihan->total_dibayar) }}
                                        </p>
                                    </div>
                                    <div>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tagihan->status == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($tagihan->status) }}
                                        </span>
                                    </div>
                                </div>
                                {{-- Detail Pembayaran untuk tagihan ini --}}
                                @if($tagihan->pembayaran->count() > 0)
                                    <div class="mt-3 border-t pt-3">
                                        <h5 class="text-sm font-semibold text-coklat-muda">Riwayat Pembayaran:</h5>
                                        <ul class="list-disc list-inside text-sm mt-2">
                                            @foreach($tagihan->pembayaran as $bayar)
                                            <li>
                                                {{ $bayar->tanggal_bayar->format('d M Y') }}: 
                                                <span class="font-semibold">Rp {{ number_format($bayar->jumlah_bayar) }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-4">Siswa ini belum memiliki riwayat tagihan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>