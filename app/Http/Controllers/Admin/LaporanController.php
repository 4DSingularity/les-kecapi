<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input bulan dan tahun, jika tidak ada, gunakan bulan dan tahun saat ini.
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        // Query siswa aktif, dan hitung jumlah pertemuan yang mereka ikuti pada periode yang dipilih.
        // Ini adalah query yang efisien, menghindari N+1 problem.
        $laporanSiswa = Siswa::where('status', 'aktif')
            ->withCount(['pertemuanYangDiikuti' => function ($query) use ($bulan, $tahun) {
                $query->whereMonth('tanggal_pertemuan', $bulan)
                      ->whereYear('tanggal_pertemuan', $tahun);
            }])
            ->get();

        // Ambil data kelas untuk biaya per pertemuan
        // Menggunakan 'keyBy' agar mudah diakses di view
        $dataKelas = \App\Models\Kelas::all()->keyBy('id');

        return view('admin.laporan.index', compact('laporanSiswa', 'dataKelas', 'bulan', 'tahun'));
    }
}