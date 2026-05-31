<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index()
    {
         $user = User::all();
        return view('user.index', compact('user'));
    }
    public function tambah()
    {
        $html = view('user.tambah')->render();
        return response()->json([
            'data' => $html
        ]);
    }
   public function simpan(Request $request)
{
    $request->validate([
        'kode_user' => 'required|unique:users,kode_user',
        'nama_user' => 'required',
        'email_user' => 'required|email|unique:users,email_user',
        'pass_user' => 'required|',
        'level_user' => 'required',
    ]);

    User::create([
        'kode_user' => $request->kode_user,
        'nama_user' => $request->nama_user,
        'email_user' => $request->email_user,
        'pass_user' => Hash::make($request->pass_user),
        'level_user' => $request->level_user,
    ]);

    
       return response()->json([
    'status' => true,
    'message' => 'Data berhasil disimpan'
]);
    }

}