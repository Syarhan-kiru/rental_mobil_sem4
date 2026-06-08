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

    public function generateKodeUser()
    {
        $userTerakhir = User::orderBy('kode_user', 'desc')->first();

        if (!$userTerakhir) {
            return 'USR001';
        }

        $angka = (int) substr($userTerakhir->kode_user, 3);
        $angkaBaru = $angka + 1;

        return 'USR' . str_pad($angkaBaru, 3, '0', STR_PAD_LEFT);
    }

    public function tambah()
    {
        $kodeUser = $this->generateKodeUser();
        $html = view('user.tambah', compact('kodeUser'))->render();
        return response()->json([
            'data' => $html
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'email_user' => 'required|email|unique:users,email_user',
            'pass_user' => 'required',
            'level_user' => 'required',
        ]);

        $kodeUser = $this->generateKodeUser();

        User::create([
            'kode_user' => $kodeUser,
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'pass_user' => Hash::make($request->pass_user),
            'level_user' => $request->level_user,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil disimpan'
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $html = view('user.edit', compact('user'))->render();

        return response()->json([
            'data' => $html
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'kode_user' => 'required|exists:users,kode_user',
            'nama_user' => 'required',
            'email_user' => 'required|email|unique:users,email_user,' . $request->kode_user . ',kode_user',
            'level_user' => 'required',
        ]);

        $user = User::findOrFail($request->kode_user);

        $data = [
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'level_user' => $request->level_user,
        ];

        if ($request->filled('pass_user')) {
            $data['pass_user'] = Hash::make($request->pass_user);
        }

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil diperbarui'
        ]);
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil dihapus'
        ]);
    }
}
