<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Menampilkan semua siswa
    public function index()
    {
        $siswas = Siswa::with('kelas')->get();
        return view('siswa.index', compact('siswas'));
    }

    // Menampilkan form tambah siswa
    public function create()
    {
        $kelas = Kelas::all(); // untuk dropdown pilihan kelas
        return view('siswa.create', compact('kelas'));
    }

    // Menyimpan siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:siswas,email',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Siswa::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // Menampilkan detail siswa (opsional)
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    // Menampilkan form edit siswa
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    // Menyimpan hasil edit
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:siswas,email,' . $siswa->id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa->update([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    // Menghapus siswa
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
