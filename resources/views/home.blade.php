@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Dokumen</h2>

    <!-- Tombol Upload -->
    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Unggah Dokumen</a>

    <!-- Tabel Daftar Dokumen -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Dokumen</th>
                <th>Jenis</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Daftar dokumen wajib
                $requiredDocuments = [
                    'Akta Kelahiran' => 'Akte',
                    'Kartu Keluarga' => 'KK',
                    'KTP' => 'KTP',
                    'Ijazah SD' => 'SD',
                    'Ijazah SMP' => 'SMP',
                    'Ijazah SMA' => 'SMA',
                    'Ijazah S1' => 'S1',
                    'Ijazah S2' => 'S2', // Misalnya harus ada
                    'SK Pengangkatan Pertama' => 'SKP',
                    'SK GTT' => 'GTT',
                    'SK GTY' => 'GTY',
                    'SK Pembagian Tugas' => 'SK',
                    'Sertifikat Pendidik' => 'Serdik',
                ];

                // Ambil daftar dokumen yang sudah diunggah
                $uploadedDocuments = $documents->pluck('document_type')->toArray();
            @endphp

            @foreach ($requiredDocuments as $docName => $docType)
                <tr>
                    <td>{{ $docName }}</td>
                    <td>{{ $docType }}</td>
                    <td>
                        @php
                            $foundDoc = $documents->where('document_type', $docType)->first();
                        @endphp
                        
                        @if ($foundDoc)
                            <a href="{{ route('documents.download', $foundDoc->id) }}" class="btn btn-primary btn-sm">Unduh</a>
                        @else
                            <span class="btn btn-danger btn-sm">Belum diunggah</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
