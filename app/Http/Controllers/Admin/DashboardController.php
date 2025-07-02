<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Pertemuan;
use App\Models\Siswa;
use App\Models\Tagihan; 

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        // Data Statistik Utama
        $jumlahSiswaAktif = Siswa::where('status', 'aktif')->count();
        $jumlahKelas = Kelas::count();
        $pertemuanBulanIni = Pertemuan::whereMonth('tanggal_pertemuan', $bulanIni)
                                      ->whereYear('tanggal_pertemuan', $tahunIni)
                                      ->count();

        $queryTagihanBulanIni = Tagihan::where('bulan', $bulanIni)->where('tahun', $tahunIni);
        
        $totalPemasukan = (clone $queryTagihanBulanIni)->sum('total_dibayar');
        $totalTagihan = (clone $queryTagihanBulanIni)->sum('total_tagihan');
        $totalTunggakan = $totalTagihan - $totalPemasukan;

        $pertemuanTerakhir = Pertemuan::with('kelas')->latest('tanggal_pertemuan')->take(5)->get();

        return view('admin.dashboard.index', compact(
            'jumlahSiswaAktif', 
            'jumlahKelas', 
            'pertemuanBulanIni',
            'totalPemasukan',
            'totalTunggakan',
            'pertemuanTerakhir'
        ));
    }
}