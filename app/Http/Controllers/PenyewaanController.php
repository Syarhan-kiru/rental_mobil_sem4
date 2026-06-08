<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\User;
use App\Models\Mobil;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenyewaanController extends Controller
{

    public function index()
    {

        $penyewaan = Penyewaan::with(['user', 'pelanggan', 'mobil'])->get();
        return view('penyewaan.index', compact('penyewaan'));
    }
    public function generateKodePenyewaan()
    {
        $penyewaanAkhir = Penyewaan::orderBy('id_penyewaan', 'desc')->first();
        if (!$penyewaanAkhir) {
            return 'PNY001';
        }

        $number = (int) substr($penyewaanAkhir->id_penyewaan, 3);
        $number++;
        return 'PNY' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
    public function tambah()
    {
        $kodePenyewaan = $this->generateKodePenyewaan();
        $user = User::all();
        $pelanggan = Pelanggan::all();
        $mobil = Mobil::where('status', 'aktif')->get();

        $html = view('penyewaan.tambah', compact(
            'kodePenyewaan',
            'user',
            'pelanggan',
            'mobil'
        ))->render();

        return response()->json([
            'data' => $html
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'kode_user' => 'required|exists:users,kode_user',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_mobil' => 'required|exists:mobil,id_mobil',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required|in:berjalan,selesai',
        ]);
        $mobil = Mobil::findOrFail($request->id_mobil);
        $kodePenyewaan = $this->generateKodePenyewaan();

        $tglSewa = Carbon::parse($request->tanggal_sewa);
        $tglKembali = Carbon::parse($request->tanggal_kembali);

        $jumlahHari = $tglSewa->diffInDays($tglKembali);


        if ($jumlahHari == 0) {
            $jumlahHari = 1;
        }


        $totalHarga = $mobil->harga_sewa_sehari * $jumlahHari;

        Penyewaan::create([
            'id_penyewaan' => $kodePenyewaan,
            'kode_user' => $request->kode_user,
            'id_pelanggan' => $request->id_pelanggan,
            'id_mobil' => $request->id_mobil,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $totalHarga,
            'status' => $request->status,
        ]);

        Mobil::where('id_mobil', $request->id_mobil)->update([
            'status' => 'disewa'
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Penyewaan berhasil ditambahkan'
        ]);
    }

    public function edit($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $user = User::all();
        $pelanggan = Pelanggan::all();
        $mobil = Mobil::where('status', 'aktif')
            ->orWhere('id_mobil', $penyewaan->id_mobil)
            ->get();

        $html = view('penyewaan.edit', compact(
            'penyewaan',
            'user',
            'pelanggan',
            'mobil'
        ))->render();

        return response()->json([
            'data' => $html
        ]);
    }

    public function update(Request $request, $id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        $validated = $request->validate([
            'kode_user' => 'required|exists:users,kode_user',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_mobil' => 'required|exists:mobil,id_mobil',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'total_harga' => 'required|integer',
            'status' => 'required|in:berjalan,selesai',
        ]);

        $penyewaan->update($validated);

        return response()->json([
            'message' => 'Data penyewaan berhasil diperbarui',
            'data' => $penyewaan
        ]);
    }

    public function hapus($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        Mobil::where('id_mobil', $penyewaan->id_mobil)->update([
            'status' => 'aktif'
        ]);

        $penyewaan->delete();

        return response()->json([
            'message' => 'Data penyewaan berhasil dihapus'
        ]);
    }
}
