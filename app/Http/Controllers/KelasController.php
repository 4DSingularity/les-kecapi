<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // Menampilkan semua data kelas
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    // Menampilkan form tambah kelas
    public function create()
    {
        return view('kelas.create');
    }

    // Menyimpan data kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    // Menampilkan satu data (tidak wajib dipakai di sistem manajemen)
    public function show(Kelas $kelas)
    {
        return view('kelas.show', compact('kelas'));
    }

    // Menampilkan form edit
    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    // Menyimpan hasil edit
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    // Menghapus data
   public function destroy($id)
   {
    $kelas = Kelas::findOrFail($id);
    $kelas->delete();
    return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
