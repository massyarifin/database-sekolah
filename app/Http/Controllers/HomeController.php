<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth; // Tambahkan ini!

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $documents = Document::where('user_id', Auth::id())->get();
        return view('home', compact('documents'));
    }
}
