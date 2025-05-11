<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::all(); // Ambil semua testimoni
        return view('userr.testimoni', compact('testimonis'));
    }

    public function create()
    {
        return view('userr.usertestimoni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'deskripsi' => 'required',
        ]);

        Testimoni::create([
            'user_id' => Auth::id(),
            'nama' => Auth::user()->name,
            'rating' => $request->rating,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil ditambahkan !');
    }

    public function edit(Testimoni $testimoni)
    {

        return view('userr.usertestimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'deskripsi' => 'required',
        ]);

        $testimoni->update([
            'rating' => $request->rating,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil diubah !');
    }

    public function destroy(Testimoni $testimoni)
    {

        $testimoni->delete();
        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dihapus !');
    }
}
