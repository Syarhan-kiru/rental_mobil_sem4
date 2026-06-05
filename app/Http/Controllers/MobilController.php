<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobil = Mobil::all();
        return view('mobil.index', compact('mobil'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function generateKodeMobil()
    {
        $mobilTerakhir = Mobil::orderBy('id_mobil', 'desc')->first();

        if (!$mobilTerakhir) {
            return 'MBL001';
        }

        $angka = (int) substr($mobilTerakhir->id_mobil, 3);
        $angkaBaru = $angka + 1;

        return 'MBL' . str_pad($angkaBaru, 3, '0', STR_PAD_LEFT);
    }
    public function tambah()
    {
         $kodeMobil = $this->generateKodeMobil();
        $html = view('mobil.tambah', compact('kodeMobil'))->render();
        return response()->json([
            'data' => $html
        ]);
    }
   
   public function simpan(Request $request)
{
    $request->validate([
        'plat_nomor' => 'required|unique:mobil,plat_nomor',
        'merek' => 'required',
        'tipe' => 'required',
        'tahun' => 'required|integer|min:1900|max:' . date('Y'),
        'harga_sewa_sehari' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'status' => 'required',
    ]);

    $kodeMobil = $this->generateKodeMobil();

    $namaFoto = null;

    if ($request->hasFile('foto')) {
        $namaFoto = $request->file('foto')->store('foto_mobil', 'public');
    }

    Mobil::create([
        'id_mobil' => $kodeMobil,
        'plat_nomor' => $request->plat_nomor,
        'merek' => $request->merek,
        'tipe' => $request->tipe,
        'tahun' => $request->tahun,
        'harga_sewa_sehari' => $request->harga_sewa_sehari,
        'foto' => $namaFoto,
        'status' => $request->status,
    ]);

    return response()->json([
        'message' => 'Data mobil berhasil disimpan'
    ]);
}
public function edit($id)
{
    $mobil = Mobil::findOrFail($id);
    $html = view('mobil.edit', compact('mobil'))->render();

    return response()->json([
        'data' => $html
    ]);
}


        
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(mobil $mobil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_mobil' => 'required|exists:mobil,id_mobil',
            'plat_nomor' => 'required|unique:mobil,plat_nomor,' . $request->id_mobil . ',id_mobil',
            'merek' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'harga_sewa_sehari' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',
        ]);

        $mobil = Mobil::findOrFail($request->id_mobil);

        $namaFoto = $mobil->foto;

        if ($request->hasFile('foto')) {
            if ($mobil->foto && Storage::disk('public')->exists($mobil->foto)) {
                Storage::disk('public')->delete($mobil->foto);
            }

            $namaFoto = $request->file('foto')->store('foto_mobil', 'public');
        }

        $mobil->update([
            'plat_nomor' => $request->plat_nomor,
            'merek' => $request->merek,
            'tipe' => $request->tipe,
            'tahun' => $request->tahun,
            'harga_sewa_sehari' => $request->harga_sewa_sehari,
            'foto' => $namaFoto,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Data mobil berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus($id)
    {
        $mobil = Mobil::findOrFail($id);

        if ($mobil->foto && Storage::disk('public')->exists($mobil->foto)) {
            Storage::disk('public')->delete($mobil->foto);
        }

        $mobil->delete();

        return response()->json([
            'message' => 'Data mobil berhasil dihapus'
        ]);
    }
}
