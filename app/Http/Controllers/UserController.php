<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function daftarMenu()
    {
        $menus = Menu::all();
        return view('userr.menu', compact('menus'));
    }

    public function tampilDetailMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        return view('userr.detail_menu', compact('menu'));
    }

    public function tambahKeKeranjang(Request $request, $menuId)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($menuId);
        $jumlah = $request->input('jumlah');
        $hargaSatuan = str_replace(['Rp', '.'], '', $menu->harga);
        $hargaSatuan = (int)preg_replace('/[^0-9]/', '', $hargaSatuan);
        $totalHarga = $hargaSatuan * $jumlah;

        Keranjang::create([
            'user_id' => Auth::id(),
            'menu_id' => $menuId,
            'jumlah' => $jumlah,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('userr.menu')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }
    public function lihatKeranjang()
    {
        $keranjangItems = Keranjang::where('user_id', Auth::id())->get();
        return view('userr.keranjang', compact('keranjangItems'));
    }

    public function hapusDariKeranjang($id)
    {
        $keranjangItem = Keranjang::findOrFail($id);

        // Pastikan hanya user yang punya item yang bisa menghapus
        if ($keranjangItem->user_id != Auth::id()) {
            return redirect()->route('userr.keranjang')->with('error', 'Anda tidak memiliki izin untuk menghapus item ini.');
        }

        $keranjangItem->delete();
        return redirect()->route('userr.keranjang')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
    public function prosesPembayaranMenu(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $menuId = $request->input('menu_id');
        $jumlah = $request->input('jumlah');

        $menu = Menu::findOrFail($menuId);
        $hargaSatuan = str_replace(['Rp', '.'], '', $menu->harga);
        $hargaSatuan = (int)preg_replace('/[^0-9]/', '', $hargaSatuan);
        $totalHarga = $hargaSatuan * $jumlah;

        $daftarMenu = [
            [
                'nama' => $menu->nama,
                'jumlah' => $jumlah,
                'harga_satuan' => $hargaSatuan,
            ]
        ];

        Pesanan::create([
            'user_id' => Auth::id(),
            'daftar_menu' => json_encode($daftarMenu),
            'total_harga' => $totalHarga,
            'status' => 'menunggu',
        ]);

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil dibuat!']);
    }
    public function prosesPembayaranKeranjang()
    {

        $keranjangItems = Keranjang::where('user_id', Auth::id())->get();
        $totalHarga = $keranjangItems->sum('total_harga');

        $daftarMenu = [];
        foreach ($keranjangItems as $item) {
            //Ambil harga satuan dari database Menu
            $menu = Menu::findOrfail($item->menu_id);
            $hargaSatuan = str_replace(['Rp', '.'], '', $menu->harga);
            $hargaSatuan = (int)preg_replace('/[^0-9]/', '', $hargaSatuan);

            $daftarMenu[] = [
                'nama' => $item->menu->nama,
                'jumlah' => $item->jumlah,
                'harga_satuan' => $hargaSatuan,
            ];
        }

        Pesanan::create([
            'user_id' => Auth::id(),
            'daftar_menu' => json_encode($daftarMenu),
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);


        Keranjang::where('user_id', Auth::id())->delete();

        return redirect()->route('userr.riwayatPesanan')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }
    public function lihatRiwayatPesanan()
    {
        $riwayatPesanan = Pesanan::where('user_id', Auth::id())->get();
        return view('userr.riwayat_pesanan', compact('riwayatPesanan'));
    }

    public function batalkanPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Pastikan hanya user yang punya pesanan yang bisa membatalkan
        if ($pesanan->user_id != Auth::id()) {
            return redirect()->route('userr.riwayatPesanan')->with('error', 'Anda tidak memiliki izin untuk membatalkan pesanan ini.');
        }

        // Pastikan pesanan masih dalam status "menunggu"
        if ($pesanan->status != 'menunggu') {
            return redirect()->route('userr.riwayatPesanan')->with('error', 'Pesanan ini tidak dapat dibatalkan karena statusnya sudah berubah.');
        }

        $pesanan->status = 'dibatalkan';
        $pesanan->save();

        return redirect()->route('userr.riwayatPesanan')->with('success', 'Pesanan berhasil dibatalkan.');
    }

        public function hapusRiwayatPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Pastikan hanya user yang punya pesanan yang bisa menghapus
        if ($pesanan->user_id != Auth::id()) {
            return redirect()->route('userr.riwayatPesanan')->with('error', 'Anda tidak memiliki izin untuk menghapus pesanan ini.');
        }

        $pesanan->delete();
        return redirect()->route('userr.riwayatPesanan')->with('success', 'Pesanan berhasil dihapus.');
    }
    
    public function prosesPembayaranKeranjangWA(Request $request)
    {
        // Validasi request
        $request->validate([
            'keranjangItems' => 'required|array',
            'totalBelanja' => 'required|numeric',
        ]);

        $keranjangItems = $request->input('keranjangItems');
        $totalHarga = $request->input('totalBelanja');


        $daftarMenu = [];
        foreach ($keranjangItems as $item) {
            $menu = Menu::findOrFail($item['menu_id']);
            $hargaSatuan = str_replace(['Rp', '.'], '', $menu->harga);
            $hargaSatuan = (int)preg_replace('/[^0-9]/', '', $hargaSatuan);

            $daftarMenu[] = [
                'nama' => $menu->nama,
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $hargaSatuan,
            ];
        }

        Pesanan::create([
            'user_id' => Auth::id(),
            'daftar_menu' => json_encode($daftarMenu),
            'total_harga' => $totalHarga,
            'status' => 'menunggu',
        ]);

        // Kosongkan keranjang setelah pesanan dibuat
        Keranjang::where('user_id', Auth::id())->delete();

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil dibuat dan keranjang dikosongkan!']);
    }

}
