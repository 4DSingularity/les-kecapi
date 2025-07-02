<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Kelas; // <-- Import model

class HomeController extends Controller
{
    public function index()
    {
        $kelasUnggulan = Kelas::take(3)->get();
        return view('welcome', compact('kelasUnggulan'));
    }
}