<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tagihan_id' => 'required|exists:tagihan,id',
            'jumlah_bayar' => 'required|integer|min:1',
            'tanggal_bayar' => 'required|date',
        ]);

        $tagihan = Tagihan::findOrFail($validated['tagihan_id']);
        $sisaTagihan = $tagihan->total_tagihan - $tagihan->total_dibayar;

        if ($validated['jumlah_bayar'] > $sisaTagihan) {
            return back()->withErrors(['jumlah_bayar' => 'Jumlah pembayaran melebihi sisa tagihan.']);
        }

        DB::transaction(function () use ($validated, $tagihan) {
            $tagihan->pembayaran()->create($validated);
            $tagihan->increment('total_dibayar', $validated['jumlah_bayar']);
            $tagihanTerbaru = $tagihan->fresh(); 
            if ($tagihanTerbaru->total_dibayar >= $tagihanTerbaru->total_tagihan) {
                $tagihanTerbaru->status = 'lunas';
            } else {               
                $tagihanTerbaru->status = 'belum lunas';
            }
            
            $tagihanTerbaru->save();
        });

        return back()->with('success', 'Pembayaran berhasil dicatat!');
    }
}