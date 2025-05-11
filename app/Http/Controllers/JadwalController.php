<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;


class JadwalController extends Controller
{
    public function index()
    {


        $jadwals = Jadwal::all();
        return view('jadwals.tampilan', compact('jadwals'));
    }

    public function create()
    {
        return view('jadwals.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hari',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'
        ]);

        jadwal::create([
        'hari' => $request->hari,
        'waktu_mulai' => $request->waktu_mulai,
        'waktu_selesai' => $request->waktu_selesai
        ]);
        return redirect()->route('jadwals.tampilan')->with('success', 'Jadwal berhasil ditambahkan !');
    }

    public function edit(jadwal $jadwal)
    {
        return view('jadwals.edit', compact('jadwal'));
    }

    public function update(Request $request, jadwal $jadwal)
    {
    $this->validate($request,[
        'hari',
        'waktu_mulai' => 'required',
        'waktu_selesai' => 'required',
    ]);



    $jadwal->update($request->all());
    return redirect()->route('jadwals.tampilan')->with('success','Jadwal berhasil diubah !');
    }

    public function destroy(jadwal $jadwal)
    {
    $jadwal->delete();

    return redirect()->route('jadwals.tampilan')->with('success','Jadwal berhasil dihapus !');
    }

}
