<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Menampilkan form unggah dokumen
    public function create()
    {
        return view('documents.upload');
    }

    // Menyimpan atau memperbarui dokumen yang diunggah
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'document_name' => 'required|string|max:255',
            'document_type' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,docx,jpg,png|max:10240', // Maksimal 10MB
        ]);

        // Cek apakah dokumen jenis ini sudah ada untuk user yang login
        $document = Document::where('user_id', Auth::id())
                            ->where('document_type', $request->document_type)
                            ->first();

        // Jika ada, hapus file lama dengan pengecekan ekstra
        if ($document && $document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        } else {
            // Jika belum ada, buat dokumen baru
            $document = new Document();
            $document->user_id = Auth::id();
            $document->document_type = $request->document_type;
        }

        // Simpan file baru
        $filePath = $request->file('file')->store('documents', 'public');

        // Update data dokumen
        $document->document_name = $request->document_name;
        $document->file_path = $filePath;
        $document->save();

        return redirect()->back()->with('success', 'Dokumen berhasil diperbarui!');
    }

    // Menampilkan daftar dokumen yang diunggah oleh pengguna
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())->get();
        return view('documents.index', compact('documents'));
    }

    // Mengunduh dokumen
    public function download($id)
    {
        $document = Document::findOrFail($id);

        // Pastikan dokumen hanya bisa diunduh oleh pemiliknya
        if ($document->user_id !== Auth::id()) {
            return abort(403, 'Akses ditolak');
        }

        // Pastikan file ada sebelum mengunduh
        if (!Storage::disk('public')->exists($document->file_path)) {
            return abort(404, 'File tidak ditemukan');
        }

        return response()->download(storage_path("app/public/" . $document->file_path), $document->document_name);
    }
}
