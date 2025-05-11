<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class UserMenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Menu::query(); // Memulai query

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%'); // Menambahkan kondisi WHERE
        }

        $menus = $query->get();  // Jalankan query dan ambil hasilnya
        return view('userr.menu', compact('menus'));
    }
}
