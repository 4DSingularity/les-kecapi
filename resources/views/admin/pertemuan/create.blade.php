@extends('layouts.app') {{-- Atau layouts.admin jika Anda punya --}}

@section('content')
<div class="container">
    <h1>Mulai Pertemuan & Absensi Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pertemuan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal_pertemuan" class="form-label">Tanggal Pertemuan</label>
            <input type="date" class="form-control" id="tanggal_pertemuan" name="tanggal_pertemuan" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="kelas_id" class="form-label">Pilih Kelas</label>
            <select class="form-select" id="kelas_id" name="kelas_id" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($daftarKelas as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="topik_hari_ini" class="form-label">Topik Pembelajaran (Opsional)</label>
            <textarea class="form-control" id="topik_hari_ini" name="topik_hari_ini" rows="3">{{ old('topik_hari_ini') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Lanjutkan ke Halaman Absensi →</button>
    </form>
</div>
@endsection