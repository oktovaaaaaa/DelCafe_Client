<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class UserGaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::all();
        return view('userr.galeri', compact('galeris'));
    }
}
