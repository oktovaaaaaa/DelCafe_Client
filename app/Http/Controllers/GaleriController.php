<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
     public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Galeri::query();

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%')->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $galeris = $query->paginate(6); // Pagination setelah pencarian
        return view('galeris.tampilan', compact('galeris'));
    }

    public function create()
    {
        return view('galeris.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $foto = $request->file('foto');
        $foto->storeAs('public/images', $foto->hashName());

        galeri::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto->hashName()
        ]);

        return redirect()->route('galeris.tampilan')->with('success', 'Galeri berhasil ditambahkan !');
    }

    public function edit(galeri $galeri)
    {
        return view('galeris.edit', compact('galeri'));
    }

    public function update(Request $request, galeri $galeri)
    {
        $this->validate($request, [
            'nama' => 'required',

        ]);

        $galeri->nama = $request->nama;
        $galeri->deskripsi = $request->deskripsi;

        if($request->hasFile('foto')){
            // hapus ftlama jika
            if($galeri->foto !== "noimage.png" && Storage::disk('public')->exists('images/'. $galeri->foto)){
                Storage::disk('public')->delete('images/'. $galeri->foto);
            }
            // utk nyimpan foto yang baru di uplod
        $foto = $request->file('foto');
        $foto->storeAs('public/images', $foto->hashName());
        $galeri->foto = $foto->hashName();
        }


        $galeri->save();

        return redirect()->route('galeris.tampilan')->with('success', 'Galeri berhasil diubah !');

    }

    public function destroy(galeri $galeri)
    {
        if ($galeri->foto !== "noimage.png" && Storage::disk('public')->exists('images/'. $galeri->foto)) {
            Storage::disk('public')->delete('images/'. $galeri->foto);
        }


        $galeri->delete();
return redirect()->route('galeris.tampilan')->with('success', 'Galeri berhasil dihapus !');
    }


}
