<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;


class AdminTestimoniController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Testimoni::query();

        if ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        }

        $testimonis = $query->get();


        return view('testimonis.tampilan', compact('testimonis', 'search')); 
    }

    public function destroy(Testimoni $testimoni)
    {

        $testimoni->delete();
        return redirect()->route('testimonis.index')->with('success', 'Testimoni berhasil dihapus !');
    }
}
