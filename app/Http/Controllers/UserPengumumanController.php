<?php

namespace App\Http\Controllers;
use App\Models\Pengumuman;

use Illuminate\Http\Request;

class UserPengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::all();
        return view('userr.pengumuman', compact('pengumumans'));
    }
}
