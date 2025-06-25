@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan & Tagihan Bulanan</h1>

    {{-- Filter Form --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.laporan.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label for="bulan" class="form-label">Bulan</label>
                    <select name="bulan" id="bulan" class="form-select">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select name="tahun" id="tahun" class="form-select">
                        @for ($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Laporan --}}
    <div class="card">
        <div class="card-header">
            Laporan untuk Bulan {{ \Carbon\Carbon::create()->month($bulan)->format('F') }} {{ $tahun }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>Jumlah Hadir</th>
                            <th>Biaya/Pertemuan</th>
                            <th>Total Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporanSiswa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->pertemuan_yang_diikuti_count }} kali</td>
                                <td>
                                    {{-- Asumsi setiap siswa hanya ikut satu jenis kelas untuk penyederhanaan --}}
                                    {{-- Untuk kasus riil, perlu logika lebih kompleks jika siswa bisa ikut banyak kelas --}}
                                    -
                                </td>
                                <td>
                                    <strong>Rp -</strong>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data untuk periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection