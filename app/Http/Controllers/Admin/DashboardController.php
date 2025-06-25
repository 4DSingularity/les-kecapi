<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Pertemuan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswaAktif = Siswa::where('status', 'aktif')->count();
        $jumlahKelas = Kelas::count();
        $pertemuanBulanIni = Pertemuan::whereMonth('tanggal_pertemuan', now()->month)
                                      ->whereYear('tanggal_pertemuan', now()->year)
                                      ->count();

        return view('admin.dashboard.index', compact('jumlahSiswaAktif', 'jumlahKelas', 'pertemuanBulanIni'));
    }
}