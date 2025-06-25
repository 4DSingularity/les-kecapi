<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Menampilkan halaman absensi dengan daftar siswa aktif.
     */
    public function create(Pertemuan $pertemuan)
    {
        $daftarSiswa = Siswa::where('status', 'aktif')->orderBy('nama_lengkap')->get();
        return view('admin.absensi.create', compact('pertemuan', 'daftarSiswa'));
    }

    /**
     * Menyimpan data absensi ke database.
     */
    public function store(Request $request, Pertemuan $pertemuan)
    {
        $request->validate([
            'siswa_ids' => 'nullable|array', // Dibuat nullable jika tidak ada yg hadir sama sekali
            'siswa_ids.*' => 'exists:siswas,id',
        ]);

        // 'sync' akan melampirkan siswa yang hadir (ada di array).
        // Siswa yang tidak ada di array akan otomatis dilepaskan (tidak diabsen).
        $pertemuan->siswaYangHadir()->sync($request->input('siswa_ids', []));

        return redirect()->route('admin.dashboard')->with('success', 'Absensi berhasil disimpan!');
    }
}