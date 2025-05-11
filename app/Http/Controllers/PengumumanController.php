<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;


class PengumumanController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');
    $query = Pengumuman::query();

    if ($search) {
        $query->where('judul', 'like', '%' . $search . '%')->orWhere('teks', 'like', '%' . $search . '%');
    }

    $pengumumans = $query->paginate(6);
        return view('pengumumans.tampilan', compact('pengumumans'));
    }

    public function create()
    {
        return view('pengumumans.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'teks' => 'required',
            'tautan' => 'nullable',
            'tanggal' => 'required'
        ]);

        pengumuman::create([
            'judul' => $request->judul,
            'teks' => $request->teks,
            'tautan' => $request->tautan ?: null,
            'tanggal' => $request->tanggal
        ]);
        return redirect()->route('pengumumans.tampilan')->with('success','Pengumuman berhasil ditambahkan !');
    }

    public function edit(pengumuman $pengumuman)
    {
        return view('pengumumans.edit', compact('pengumuman'));;
    }

    public function update(Request $request, pengumuman $pengumuman )
    {
        $this->validate($request,[
            'judul' => 'required',
            'teks' => 'required',
            'tautan' => 'nullable|url',
            'tanggal' => 'required',
        ]);
        $pengumuman->judul = $request->judul;
        $pengumuman->teks = $request->teks;
        $pengumuman->tautan = $request->tautan ?: null;
        $pengumuman->tanggal = $request->tanggal;

        $pengumuman->update();
        return redirect()->route('pengumumans.tampilan')->with('success','Pengumuman berhasil diubah !');

    }

    public function destroy(pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumumans.tampilan')->with('success','Pengumuman berhasil dihapus !');

    }


}
