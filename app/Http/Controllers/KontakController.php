<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;


class KontakController extends Controller
{
    // public function index()
    // {
    //     $kontaks = Kontak::all();
    //     return view('userr.kontak', compact('kontaks'));
    // }

    public function create()
    {
        return view('userr.kontak');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'nullable|email',
            'subjek' => 'required',
            'pesan' => 'required'
        ]);
        Kontak::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan
        ]);


        // return response()->json(['success' => 'Pesan anda sudah terkirimkan']);

        return back()->with('success', 'Pesan anda berhasil dikirim !');
    }
}
