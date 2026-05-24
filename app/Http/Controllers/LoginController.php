<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller{

public function index (){
    return view('login.view');
}

public function proses(Request $request){
    $request->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);
    $user = User::where('email_user', $request->email)->first();
    if($user && Hash::check($request->password,$user->pass_user)){
        Auth::login($user);
        $request->session()->regenerate();
        session([
            'kode_user'=> $user->kode_user,
            'nama_user'=> $user->nama_user,
            'level_user'=> $user->level_user
        ]);
        return redirect('/dashboard');
    }else{
        return back()
        ->with('error', 'Password atau Email salah')
        ->withInput();

    }
}

public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}
}