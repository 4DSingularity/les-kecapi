@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Absensi Kelas: {{ $pertemuan->kelas->nama_kelas }}</h1>
    <p>Tanggal: {{ $pertemuan->tanggal_pertemuan->format('d F Y') }}</p>

    <form action="{{ route('admin.absensi.store', $pertemuan->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                Daftar Siswa Aktif
            </div>
            <div class="card-body">
                @if($daftarSiswa->isEmpty())
                    <p class="text-center">Tidak ada siswa aktif yang terdaftar.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Hadir?</th>
                                    <th>Nama Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarSiswa as $siswa)
                                    <tr>
                                        <td>
                                            <div class="form-check form-switch fs-4">
                                                <input class="form-check-input" type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}" id="siswa_{{ $siswa->id }}" checked>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="form-check-label" for="siswa_{{ $siswa->id }}">
                                                {{ $siswa->nama_lengkap }}
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection