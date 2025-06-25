<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Menampilkan semua data jadwal
    public function index()
    {
        $jadwal = Jadwal::with('kelas')->get();
        return view('jadwal.index', compact('jadwal'));
    }

    // Form tambah jadwal
    public function create()
    {
        $kelas = Kelas::all(); // untuk dropdown kelas
        return view('jadwal.create', compact('kelas'));
    }

    // Menyimpan data jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'hari'      => 'required|string|max:20',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kelas_id'  => 'required|exists:kelas,id',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menampilkan detail jadwal (opsional)
    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    // Form edit jadwal
    public function edit(Jadwal $jadwal)
    {
        $kelas = Kelas::all();
        return view('jadwal.edit', compact('jadwal', 'kelas'));
    }

    // Update data jadwal
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'hari'        => 'required|string|max:20',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kelas_id'    => 'required|exists:kelas,id',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    // Menghapus jadwal
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
