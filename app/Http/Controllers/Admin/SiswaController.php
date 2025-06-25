<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar semua siswa.
     */
    public function index()
    {
        $daftarSiswa = Siswa::latest()->paginate(10);
        return view('admin.siswa.index', compact('daftarSiswa'));
    }

    /**
     * Menampilkan form untuk membuat siswa baru.
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Menyimpan siswa baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:15',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Siswa::create($request->all());

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Siswa baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit siswa.
     */
    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Memperbarui data siswa di database.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:15',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $siswa->update($request->all());

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Menghapus siswa dari database.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil dihapus.');
    }
}