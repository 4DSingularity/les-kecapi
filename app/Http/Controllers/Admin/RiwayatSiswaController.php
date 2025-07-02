<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class RiwayatSiswaController extends Controller
{
    /**
     * Menampilkan riwayat tagihan dan pembayaran untuk seorang siswa.
     */
    public function index(Siswa $siswa, Request $request)
    {
        // Eager load relasi tagihan dan pembayaran di dalamnya
        $siswa->load(['tagihan' => function ($query) {
            $query->with('pembayaran')->orderBy('tahun', 'desc')->orderBy('bulan', 'desc');
        }]);

        // Hitung rekapitulasi total
        $totalSemuaTagihan = $siswa->tagihan->sum('total_tagihan');
        $totalSemuaPembayaran = $siswa->tagihan->sum('total_dibayar');
        $totalTunggakan = $totalSemuaTagihan - $totalSemuaPembayaran;

        return view('admin.riwayat_siswa.index', compact(
            'siswa', 
            'totalSemuaTagihan', 
            'totalSemuaPembayaran', 
            'totalTunggakan'
        ));
    }
}