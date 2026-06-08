<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use App\Models\Mobil;

class PengembalianController extends Controller
{
       public function index()
    {
        $data = [
          
            'pengembalian' => Pengembalian::with('penyewaan.pelanggan', 'penyewaan.mobil')->get()
        ];
        return view('pengembalian.index', $data);
    }

   
    public function tambah()
{
    
    $penyewaanAktiv = Penyewaan::with(['pelanggan', 'mobil'])
                        ->where('status', 'berjalan')
                        ->get();

    
    $cek = Pengembalian::count();
    $kodePengembalian = 'KB-' . sprintf("%03d", $cek + 1);

    
    $msg = [
        'data' => view('pengembalian.tambah', compact('penyewaanAktiv', 'kodePengembalian'))->render()
    ];

    return response()->json($msg);
}

        public function simpan(Request $request)
    {
       
        Pengembalian::create([
            'id_pengembalian' => $request->id_pengembalian,
            'id_penyewaan' => $request->id_penyewaan,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
            'kondisi_mobil' => $request->kondisi_mobil,
            'denda' => $request->denda,
            'total_bayar' => $request->total_bayar 
        ]);

       
        $penyewaan = Penyewaan::find($request->id_penyewaan);
        
        if ($penyewaan) {
          
            $penyewaan->update(['status' => 'selesai']);

           
            Mobil::where('id_mobil', $penyewaan->id_mobil)->update(['status' => 'aktif']);
        }

        return response()->json(['message' => 'Data pengembalian sukses diproses!']);
    }

   
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

    
    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::find($id);
        $pengembalian->update([
            'id_penyewaan' => $request->id_penyewaan,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
            'kondisi_mobil' => $request->kondisi_mobil,
            'denda' => $request->denda,
            'total_bayar' => $request->total_bayar
        ]);

        return response()->json(['message' => 'Data pengembalian berhasil diupdate!']);
    }

    
    public function hapus($id)
    {
        $pengembalian = Pengembalian::find($id);
        if ($pengembalian) {
            Penyewaan::where('id_penyewaan', $pengembalian->id_penyewaan)->update(['status' => 'berjalan']);
            $pengembalian->delete();
        }
        return response()->json(['message' => 'Data pengembalian berhasil dihapus!']);
    }
}