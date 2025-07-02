<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-tua leading-tight">
            {{ __('Laporan & Tagihan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Filter Form (Tidak ada perubahan di sini) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                {{-- ... Kode form filter Anda ... --}}
            </div>

            {{-- Tabel Laporan --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- [PERBAIKAN] Gunakan variabel dari controller --}}
                    <h3 class="text-lg font-medium mb-4 text-coklat-tua">
                        Laporan untuk {{ $judulLaporan }}
                    </h3>
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="w-full text-sm text-left text-coklat-muda">
                            <thead class="text-xs text-coklat-tua uppercase bg-krem">
                                <tr>
                                    <th class="px-6 py-3">No.</th>
                                    <th class="px-6 py-3">Nama Siswa</th>
                                    @if($bulan == 'semua')<th class="px-6 py-3">Bulan</th>@endif
                                    <th class="px-6 py-3 text-right">Total Tagihan</th>
                                    <th class="px-6 py-3 text-right">Dibayar</th>
                                    <th class="px-6 py-3 text-right">Sisa Tagihan</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporanTagihan as $tagihan)
                                    @php $sisaTagihan = $tagihan->total_tagihan - $tagihan->total_dibayar; @endphp
                                    <tr class="bg-white border-b hover:bg-krem/50">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 font-medium text-coklat-tua">{{ $tagihan->siswa->nama_lengkap ?? 'Siswa Dihapus' }}</td>
                                        @if($bulan == 'semua')
                                            <td class="px-6 py-4">
                                                {{-- [PERBAIKAN] Gunakan Carbon dengan aman --}}
                                                {{ \Carbon\Carbon::create()->month($tagihan->bulan)->isoFormat('MMM') }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 text-right">Rp {{ number_format($tagihan->total_tagihan) }}</td>
                                        <td class="px-6 py-4 text-right">Rp {{ number_format($tagihan->total_dibayar) }}</td>
                                        <td class="px-6 py-4 text-right font-semibold text-coklat-tua">Rp {{ number_format($sisaTagihan) }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tagihan->status == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($tagihan->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($sisaTagihan > 0)
                                                <button onclick="openPaymentModal({{ $tagihan->id }}, {{ $sisaTagihan }})" class="font-medium text-terakota hover:underline">Bayar</button>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="{{ $bulan == 'semua' ? '9' : '8' }}" class="text-center py-6 text-gray-500">Tidak ada data tagihan untuk periode ini.</td>
                                @endforelse
                            </tbody>
                            @if($laporanTagihan->isNotEmpty())
                            <tfoot class="font-semibold text-coklat-tua bg-krem">
                                {{-- ... Kode tfoot Anda (sudah benar) ... --}}
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal/Popup untuk Pembayaran -->
    <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-coklat-tua text-center">Input Pembayaran</h3>
                <div class="mt-2 px-7 py-3">
                    <form id="paymentForm" action="{{ route('admin.pembayaran.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tagihan_id" id="tagihan_id">
                        <div class="mb-4 text-left">
                            <label for="jumlah_bayar" class="text-sm font-medium text-coklat-muda">Jumlah Bayar (Rp)</label>
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm" required>
                        </div>
                         <div class="mb-4 text-left">
                            <label for="tanggal_bayar" class="text-sm font-medium text-coklat-muda">Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar" id="tanggal_bayar" value="{{ date('Y-m-d') }}" class="mt-1 block w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm" required>
                        </div>
                        <div class="items-center px-4 py-3 bg-gray-50 -mx-5 -mb-5 mt-6 rounded-b-md">
                            <div class="flex justify-end">
                                <button type="button" onclick="closePaymentModal()" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                                    Batal
                                </button>
                                <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                                    Simpan Pembayaran
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
<script>
    function openPaymentModal(tagihanId, sisaTagihan) {
        document.getElementById('paymentModal').classList.remove('hidden');
        document.getElementById('tagihan_id').value = tagihanId;
        document.getElementById('jumlah_bayar').value = sisaTagihan;
        document.getElementById('jumlah_bayar').max = sisaTagihan;
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').classList.add('hidden');
    }
</script>
@endpush
</x-app-layout>