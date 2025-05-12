<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User;

class RiwayatAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Pesanan::query()->where('status', '!=', 'dibatalkan');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
                ->orWhere('daftar_menu', 'LIKE', '%' . $search . '%');
        }

        $semuaRiwayatPesanan = $query->with('user')->get();

        // Pastikan laporan harian selalu dihitung saat halaman dimuat
        $this->hitungLaporanHarian($semuaRiwayatPesanan); // Pass $semuaRiwayatPesanan

        $laporanHarian = session('laporanHarian');

        return view('riwayat.tampilan', compact('semuaRiwayatPesanan', 'laporanHarian'));
    }

    public function approveRejectPesanan(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:berhasil,ditolak',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status != 'menunggu') {
            return redirect()->back()->with('error', 'Pesanan ini tidak dapat diubah statusnya.');
        }

        $action = $request->input('action');
        $pesanan->status = $action;
        $pesanan->save();

        // Hitung Ulang Laporan Harian
        $semuaRiwayatPesanan = Pesanan::where('status', '!=', 'dibatalkan')->with('user')->get();
        $this->hitungLaporanHarian($semuaRiwayatPesanan); // Pass $semuaRiwayatPesanan

        // Redirect ke halaman riwayat.tampilan setelah berhasil
        return redirect()->route('riwayat.tampilan')->with('success', 'Status pesanan berhasil diubah menjadi ' . $action);
    }

    public function hapusHarian(Request $request)
    {
        $selectedTangal = $request->input('selected_tanggal');
        $search = $request->input('search'); // Ambil keyword pencarian

        if ($selectedTangal) {
            foreach ($selectedTangal as $tanggal) {
                // Bangun query dasar
                $query = Pesanan::whereDate('created_at', $tanggal);

                // Tambahkan kondisi pencarian jika ada
                if ($search) {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', '%' . $search . '%');
                    })
                        ->orWhere('daftar_menu', 'LIKE', '%' . $search . '%');
                }

                // Hapus pesanan yang memenuhi kriteria
                $query->delete();
            }

            // Hitung Ulang Laporan Harian Setelah Penghapusan
            $semuaRiwayatPesanan = Pesanan::where('status', '!=', 'dibatalkan')->with('user')->get();
            $this->hitungLaporanHarian($semuaRiwayatPesanan); // Pass $semuaRiwayatPesanan

            return redirect()->back()->with('success', 'Riwayat pesanan harian yang dipilih berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada riwayat pesanan harian yang dipilih.');
        }
    }

    private function hitungLaporanHarian($semuaRiwayatPesanan)
    {
        $laporanHarian = [];

        foreach ($semuaRiwayatPesanan as $pesanan) {
            if ($pesanan->status == 'berhasil') {
                $tanggal = $pesanan->created_at->format('Y-m-d');
                $daftarMenu = json_decode($pesanan->daftar_menu, true);

                foreach ($daftarMenu as $menu) {
                    $namaMenu = $menu['nama'];
                    $jumlah = $menu['jumlah'];
                    $hargaSatuan = $menu['harga_satuan'];

                    if (!isset($laporanHarian[$tanggal][$namaMenu])) {
                        $laporanHarian[$tanggal][$namaMenu] = [
                            'total_terjual' => 0,
                            'total_harga' => 0,
                        ];
                    }

                    $laporanHarian[$tanggal][$namaMenu]['total_terjual'] += $jumlah;
                    $laporanHarian[$tanggal][$namaMenu]['total_harga'] += $jumlah * $hargaSatuan;
                }
            }
        }

        // Simpan laporan harian ke session
        session(['laporanHarian' => $laporanHarian]);
    }
}
