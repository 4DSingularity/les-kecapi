<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    /**
     * Menampilkan form untuk membuat pertemuan baru.
     */
    public function create()
    {
        $daftarKelas = Kelas::all();
        return view('admin.pertemuan.create', compact('daftarKelas'));
    }

    /**
     * Menyimpan data pertemuan dan mengarahkan ke halaman absensi.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_pertemuan' => 'required|date',
            'topik_hari_ini' => 'nullable|string',
        ]);

        $pertemuan = Pertemuan::create($request->all());

        // Redirect ke halaman absensi untuk pertemuan yang baru dibuat
        return redirect()->route('admin.absensi.create', ['pertemuan' => $pertemuan->id]);
    }
}