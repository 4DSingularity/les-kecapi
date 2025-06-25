<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar semua kelas.
     */
    public function index()
    {
        $daftarKelas = Kelas::latest()->paginate(10);
        return view('admin.kelas.index', compact('daftarKelas'));
    }

    /**
     * Menampilkan form untuk membuat kelas baru.
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * Menyimpan kelas baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'biaya_per_pertemuan' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Kelas baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kelas.
     */
    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', compact('kela'));
    }

    /**
     * Memperbarui data kelas di database.
     */
    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $kela->id,
            'biaya_per_pertemuan' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $kela->update($request->all());

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Menghapus kelas dari database.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Data kelas berhasil dihapus.');
    }
}