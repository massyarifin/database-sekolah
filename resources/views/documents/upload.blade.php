<!-- resources/views/documents/upload.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Unggah Dokumen</h1>
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="document_name">Nama Dokumen</label>
            <input type="text" name="document_name" id="document_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="document_type">Jenis Dokumen</label>
            <select name="document_type" id="document_type" class="form-control" required>
                <option value="akte">Akte</option>
                <option value="kk">Kartu Keluarga</option>
                <option value="ktp">KTP</option>
                <option value="ijazah">Ijazah</option>
                <!-- Tambahkan jenis dokumen lainnya jika perlu -->
            </select>
        </div>

        <div class="form-group">
            <label for="file">Pilih Dokumen</label>
            <input type="file" name="file" id="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Unggah</button>
    </form>
</div>
@endsection
