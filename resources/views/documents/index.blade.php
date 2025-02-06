@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dokumen Saya</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Dokumen</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->document_name }}</td>
                <td>{{ $document->document_type }}</td>
                <td>
                    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-primary btn-sm">Unduh</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
