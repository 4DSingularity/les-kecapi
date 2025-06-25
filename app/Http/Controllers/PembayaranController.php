<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        $pembayaran = Pembayaran::with('siswa')->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    // Form tambah pembayaran
    public function create()
    {
        $siswa = Siswa::all(); // untuk dropdown
        return view('pembayaran.create', compact('siswa'));
    }

    // Simpan pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'    => 'required|exists:siswas,id',
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|numeric|min:0',
            'keterangan'  => 'nullable|string|max:255',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

    // Detail pembayaran (opsional)
    public function show(Pembayaran $pembayaran)
    {
        return view('pembayaran.show', compact('pembayaran'));
    }

    // Form edit pembayaran
    public function edit(Pembayaran $pembayaran)
    {
        $siswa = Siswa::all();
        return view('pembayaran.edit', compact('pembayaran', 'siswa'));
    }

    // Simpan hasil edit
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'siswa_id'    => 'required|exists:siswas,id',
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|numeric|min:0',
            'keterangan'  => 'nullable|string|max:255',
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    // Hapus pembayaran
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
