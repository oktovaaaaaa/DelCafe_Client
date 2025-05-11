<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Menu::query();

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%')->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $menus = $query->paginate(8);

        return view('menus.tampilan', compact('menus', 'search'));

        // $menus = Menu::paginate(12);

        // return view('menus.tampilan', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $foto = $request->file('foto');
        $foto->storeAs('public/images', $foto->hashName());

        menu::create([
            'nama' => $request->nama,
            'harga' => str_replace(".", "", $request->harga),
            'deskripsi' => $request->deskripsi,
            'foto' => $foto->hashName()
        ]);

        return redirect()->route('menus.tampilan')->with('success', 'Menu berhasil ditambahkan !');
    }

    public function edit(menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, menu $menu)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
        ]);


        $menu->nama = $request->nama;
        $menu->harga = str_replace(".", "", $request->harga);
        $menu->deskripsi = $request->deskripsi;

        if ($request->file('foto')) {

            if ($request->hasFile('foto')) {
                // hapus ftlama jika
                if ($menu->foto !== "noimage.png" && Storage::disk('public')->exists('images/' . $menu->foto)) {
                    Storage::disk('public')->delete('images/' . $menu->foto);
                }


                $foto = $request->file('foto');
                $foto->storeAs('public/images', $foto->hashName());
                $menu->foto = $foto->hashName();
            }
        }

        $menu->update();

        return redirect()->route('menus.tampilan')->with('success', 'Menu berhasil diubah !');
    }

    public function destroy(menu $menu)
    {
        // if ($menu->foto !== "noimage.png") {
        //     Storage::disk('local')->delete('public/' . $menu->foto);
        // }
        if ($menu->foto !== "noimage.png" && Storage::disk('public')->exists('images/' . $menu->foto)) {
            Storage::disk('public')->delete('images/' . $menu->foto);
        }


        $menu->delete();

        return redirect()->route('menus.tampilan')->with('success', 'Menu berhasil dihapus !');
    }
}
