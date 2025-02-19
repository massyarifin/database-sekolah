<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/documents/upload', [DocumentController::class, 'create'])->name('documents.create');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
});
