<!-- resources/views/documents/upload.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Unggah Dokumen</h1>

    {{-- Tombol Kembali ke Home --}}
    <a href="{{ url('/home') }}" class="btn btn-secondary mb-3">Kembali ke Home</a>

    {{-- Notifikasi Sukses Upload --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="document_name">Nama Dokumen</label>
            <input type="text" name="document_name" id="document_name" class="form-control" required 
            placeholder="Contoh: Ijazah S1_Yunita Dela Anggraeni">
            <small class="text-muted">Gunakan Format: Ijazah S1_Nama Lengkap (Hanya File PDF)</small>
        </div>

        <div class="form-group">
            <label for="document_type">Jenis Dokumen</label>
            <select name="document_type" id="document_type" class="form-control" required>
                <option value="Akte">Akta Kelahiran</option>
                <option value="KK">Kartu Keluarga</option>
                <option value="KTP">KTP</option>
                <option value="SD">Ijazah SD</option>
                <option value="SMP">Ijazah SMP</option>
                <option value="SMA">Ijazah SMA</option>
                <option value="S1">Ijazah S1</option>
                <option value="S2">Ijazah S2</option>
                <option value="SKP">SK Pengangkatan Pertama</option>
                <option value="GTT">SK GTT</option>
                <option value="GTY">SK GTY</option>
                <option value="SK">SK Pembagian Tugas</option>
                <option value="Serdik">Sertifikat Pendidik</option>
                <!-- Tambahkan jenis dokumen lainnya jika perlu -->
            </select>
        </div>

        <div class="form-group">
            <label for="file">Pilih Dokumen</label>
            <input type="file" name="file" id="file" class="form-control" required accept=".pdf">
            <small class="text-muted">Hanya file PDF yang diizinkan. Maksimal 1MB.</small>
        </div>

        <button type="submit" class="btn btn-primary">Unggah</button>
    </form>
</div>
@endsection
