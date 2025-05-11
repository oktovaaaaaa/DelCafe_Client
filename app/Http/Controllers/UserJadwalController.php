<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;


class UserJadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('userr.jadwal',compact('jadwals'));
    }
}
