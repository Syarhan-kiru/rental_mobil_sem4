<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
   
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

   public function generateKodePelanggan()
    {
        $pelangganAkhir = Pelanggan::orderBy('id_pelanggan', 'desc')->first();
        if (!$pelangganAkhir) {
            return 'PLG001';
        }

        $number = (int) substr($pelangganAkhir->id_pelanggan, 3);
        $newNumber = $number + 1;
        return 'PLG' . str_pad( $newNumber, 3, '0', STR_PAD_LEFT);
    }
    
    public function tambah()
    {
        $kodePelanggan = $this->generateKodePelanggan();
        $html = view('pelanggan.tambah', compact('kodePelanggan'))->render();

        return response()->json([
            'data' => $html
        ]);
    }

    
    

   
    public function simpan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'nik' => 'required|unique:pelanggan,nik',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $kodePelanggan = $this->generateKodePelanggan();

        Pelanggan::create([
            'id_pelanggan'   => $kodePelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'nik'            => $request->nik,
            'no_hp'          => $request->no_hp,
            'alamat'         => $request->alamat,
        ]);

        // jika disubmit via halaman biasa, redirect ke index
        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil ditambahkan');
    }
    public function edit($id)
{
    $pelanggan = Pelanggan::findOrFail($id);
    $html = view('pelanggan.edit', compact('pelanggan'))->render();

    return response()->json([
        'data' => $html
    ]);
}
public function update(Request $request)
    {
         $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'nama_pelanggan' => 'required',
            'nik' => 'required|unique:pelanggan,nik,' . $request->id_pelanggan . ',id_pelanggan',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $pelanggan = Pelanggan::findOrFail($request->id_pelanggan);

        

       

        $pelanggan->update([
           'id_pelanggan'   => $request->id_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'nik'            => $request->nik,
            'no_hp'          => $request->no_hp,
            'alamat'         => $request->alamat,
        ]);

        return response()->json([
            'message' => 'Data pelanggan berhasil diperbarui'
        ]);
    }

    public function hapus($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return response()->json([
            'message' => 'Data pelanggan berhasil dihapus'
        ]);
    }

}
