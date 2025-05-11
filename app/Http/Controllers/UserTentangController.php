<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tentang;

class UserTentangController extends Controller
{
    public function index()
    {
        $tentangs = Tentang::all();
        return view('userr.tentang', compact('tentangs'));
    }
}
