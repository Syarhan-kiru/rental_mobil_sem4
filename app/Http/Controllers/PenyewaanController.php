<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    
    public function index()
    {
        $penyewaan = Penyewaan::with(['user','pelanggan','mobil'])->get();
        return response()->json($penyewaan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_user'       => 'required|exists:users,kode_user',
            'id_pelanggan'    => 'required|exists:pelanggan,id_pelanggan',
            'id_mobil'        => 'required|exists:mobil,id_mobil',
            'tanggal_sewa'    => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'total_harga'     => 'required|integer',
            'status'          => 'required|in:berjalan,selesai',
        ]);

        $penyewaan = Penyewaan::create($validated);

        return response()->json([
            'message' => 'Data penyewaan berhasil ditambahkan',
            'data'    => $penyewaan
        ]);
    }

    public function show($id)
    {
        $penyewaan = Penyewaan::with(['user','pelanggan','mobil'])->findOrFail($id);
        return response()->json($penyewaan);
    }

    public function update(Request $request, $id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        $validated = $request->validate([
            'kode_user'       => 'required|exists:users,kode_user',
            'id_pelanggan'    => 'required|exists:pelanggan,id_pelanggan',
            'id_mobil'        => 'required|exists:mobil,id_mobil',
            'tanggal_sewa'    => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'total_harga'     => 'required|integer',
            'status'          => 'required|in:berjalan,selesai',
        ]);

        $penyewaan->update($validated);

        return response()->json([
            'message' => 'Data penyewaan berhasil diperbarui',
            'data'    => $penyewaan
        ]);
    }

    public function destroy($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $penyewaan->delete();

        return response()->json([
            'message' => 'Data penyewaan berhasil dihapus'
        ]);
    }
}
