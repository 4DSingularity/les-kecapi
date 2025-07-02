<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // ... (logika generateTagihan tidak perlu diubah, biarkan seperti di jawaban sebelumnya)

        $bulan = $request->input('bulan', now()->month);
        $tahun = (int) $request->input('tahun', now()->year);

        // Hanya generate tagihan jika bulan spesifik dipilih
        if ($bulan !== 'semua') {
            $this->generateTagihanUntukPeriode((int) $bulan, $tahun);
        }

        // Query data tagihan
        $query = Tagihan::query()->with('siswa');

        if ($bulan !== 'semua') {
            $query->where('bulan', (int) $bulan)->where('tahun', $tahun);
        } else {
            $query->where('tahun', $tahun);
        }
        
        $laporanTagihan = $query->orderBy('bulan')->orderBy('siswa_id')->get();
        
        $totalKeseluruhan = [
            'total_tagihan' => $laporanTagihan->sum('total_tagihan'),
            'total_dibayar' => $laporanTagihan->sum('total_dibayar'),
            'sisa_tagihan' => $laporanTagihan->sum('total_tagihan') - $laporanTagihan->sum('total_dibayar'),
        ];

        $judulLaporan = "Tahun " . $tahun;
        if ($bulan !== 'semua') {
            $judulLaporan = "Bulan " . Carbon::create()->month((int)$bulan)->isoFormat('MMMM') . " " . $tahun;
        }

        return view('admin.laporan.index', compact('laporanTagihan', 'bulan', 'tahun', 'totalKeseluruhan', 'judulLaporan'));
    }
    private function generateTagihanUntukPeriode(int $bulan, int $tahun)
    {
        $siswaDenganPertemuan = Siswa::where('status', 'aktif')
            ->with(['pertemuanYangDiikuti' => function ($query) use ($bulan, $tahun) {
                $query->whereMonth('tanggal_pertemuan', $bulan)
                    ->whereYear('tanggal_pertemuan', $tahun)
                    ->with('kelas');
            }])->get();

        DB::transaction(function() use ($siswaDenganPertemuan, $bulan, $tahun) {
            foreach ($siswaDenganPertemuan as $siswa) {
                $jumlahHadir = $siswa->pertemuanYangDiikuti->count();
                
                if ($jumlahHadir > 0) {
                    $biayaPerPertemuan = $siswa->pertemuanYangDiikuti->first()->kelas->biaya_per_pertemuan ?? 0;
                    $totalTagihanBulanIni = $jumlahHadir * $biayaPerPertemuan;

                    $tagihan = Tagihan::firstOrNew([
                        'siswa_id' => $siswa->id,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                    ]);

                    $tagihan->total_tagihan = $totalTagihanBulanIni;
                    
                    if ($tagihan->total_dibayar >= $tagihan->total_tagihan) {
                        $tagihan->status = 'lunas';
                    } else {
                        $tagihan->status = 'belum lunas';
                    }
                    
                    $tagihan->save();
                }
            }
        });
    }
}