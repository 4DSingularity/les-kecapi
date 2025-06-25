<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    // Menampilkan semua data materi
    public function index()
    {
        $materi = Materi::with('kelas')->get();
        return view('materi.index', compact('materi'));
    }

    // Menampilkan form tambah materi
    public function create()
    {
        $kelas = Kelas::all();
        return view('materi.create', compact('kelas'));
    }

    // Menyimpan data materi baru
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file'      => 'nullable|file|mimes:pdf,mp4,mp3,docx,doc|max:10240',
            'kelas_id'  => 'required|exists:kelas,id',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('materi', 'public');
        }

        Materi::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file'      => $path,
            'kelas_id'  => $request->kelas_id,
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    // Menampilkan detail materi (opsional)
    public function show(Materi $materi)
    {
        return view('materi.show', compact('materi'));
    }

    // Menampilkan form edit materi
    public function edit(Materi $materi)
    {
        $kelas = Kelas::all();
        return view('materi.edit', compact('materi', 'kelas'));
    }

    // Menyimpan perubahan materi
    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file'      => 'nullable|file|mimes:pdf,mp4,mp3,docx,doc|max:10240',
            'kelas_id'  => 'required|exists:kelas,id',
        ]);

        $data = [
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kelas_id'  => $request->kelas_id,
        ];

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('materi', 'public');
        }

        $materi->update($data);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    // Menghapus data materi
    public function destroy(Materi $materi)
    {
        $materi->delete();
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
