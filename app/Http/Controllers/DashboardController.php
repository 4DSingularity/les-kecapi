<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalKelas' => Kelas::count(),
            'totalSiswa' => Siswa::count(),
            'totalJadwal' => Jadwal::count(),
            'totalMateri' => Materi::count(),
            'totalPembayaran' => Pembayaran::count(),
        ]);
    }
}
?>