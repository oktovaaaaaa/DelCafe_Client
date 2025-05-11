<?php

namespace App\Http\Controllers;
use App\Models\Kontak;
use Illuminate\Http\Request;

class AdminKontakController extends Controller
{
    public function index(Request $request)
    {
            $search = $request->input('search');
            $query = Kontak::query();

            if ($search) {
                $query->where('nama', 'like', '%' . $search . '%')->orWhere('pesan', 'like', '%' . $search . '%');
            }

        $kontaks = $query->paginate(8);
        return view('kontaks.tampilan', compact('kontaks'));
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->route('kontaks.tampilan')->with('success', 'Pesan berhasil di hapus!');
    }
}
