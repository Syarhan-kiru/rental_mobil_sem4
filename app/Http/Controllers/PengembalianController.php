<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use App\Models\Mobil;

class PengembalianController extends Controller
{
    // 1. Tampilkan Halaman Utama
    public function index()
    {
        $data = [
            // Mengambil riwayat pengembalian bersama relasi penyewaan, pelanggan, dan mobil
            'pengembalian' => Pengembalian::with('penyewaan.pelanggan', 'penyewaan.mobil')->get()
        ];
        return view('pengembalian.index', $data);
    }

    // 2. Ambil Modal Tambah (Merespon AJAX GET)
    public function tambah()
{
    // Mengambil antrean data sewa yang statusnya masih 'berjalan'
    $penyewaanAktiv = \App\Models\Penyewaan::with(['pelanggan', 'mobil'])
                        ->where('status', 'berjalan')
                        ->get();

    // Membuat kode pengembalian otomatis otomatis (Contoh: KB-001)
    $cek = \App\Models\Pengembalian::count();
    $kodePengembalian = 'KB-' . sprintf("%03d", $cek + 1);

    // Render file view tambah ke bentuk teks HTML untuk disemprotkan oleh AJAX
    $msg = [
        'data' => view('pengembalian.tambah', compact('penyewaanAktiv', 'kodePengembalian'))->render()
    ];

    return response()->json($msg);
}

    // 3. Simpan Data & Update Status Mobil/Sewa Otomatis
    public function simpan(Request $request)
    {
        // Simpan ke tabel pengembalians
        Pengembalian::create([
            'id_pengembalian' => $request->id_pengembalian,
            'id_penyewaan' => $request->id_penyewaan,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
            'kondisi_mobil' => $request->kondisi_mobil,
            'denda' => $request->denda,
            'total_payar' => $request->total_bayar // mengambil dari input total_bayar di form
        ]);

        // LOGIKA OTOMATIS:
        // A. Ambil data transaksi penyewaannya
        $penyewaan = Penyewaan::find($request->id_penyewaan);
        
        if ($penyewaan) {
            // B. Ubah status sewa menjadi selesai
            $penyewaan->update(['status' => 'selesai']);

            // C. Ubah status mobil terkait kembali menjadi tersedia
            Mobil::where('id_mobil', $penyewaan->id_mobil)->update(['status' => 'tersedia']);
        }

        return response()->json(['message' => 'Data pengembalian sukses diproses!']);
    }

    // 4. Ambil Modal Edit (Merespon AJAX GET)
    public function edit($id)
    {
        $data = [
            'pengembalian' => Pengembalian::find($id),
            'penyewaan' => Penyewaan::with('pelanggan', 'mobil')->get()
        ];

        return response()->json([
            'data' => view('pengembalian.edit', $data)->render()
        ]);
    }

    // 5. Update Data
    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::find($id);
        $pengembalian->update([
            'id_penyewaan' => $request->id_penyewaan,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
            'kondisi_mobil' => $request->kondisi_mobil,
            'denda' => $request->denda,
            'total_payar' => $request->total_bayar
        ]);

        return response()->json(['message' => 'Data pengembalian berhasil diupdate!']);
    }

    // 6. Hapus Data
    public function hapus($id)
    {
        $pengembalian = Pengembalian::find($id);
        
        if ($pengembalian) {
            // Jika dihapus, kembalikan status transaksi sewanya menjadi berjalan kembali
            Penyewaan::where('id_penyewaan', $pengembalian->id_penyewaan)->update(['status' => 'berjalan']);
            $pengembalian->delete();
        }

        return response()->json(['message' => 'Data pengembalian berhasil dihapus!']);
    }
}