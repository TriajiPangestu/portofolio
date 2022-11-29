<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __constract() {
        $this->middleware('Auth')->except('logout');
    }

    public function index() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

    return back()->withErrors([
        'email' => 'Email atau Password salah',
        ])->onlyInput('email');

    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function store(Request $request) {
        $request->validate([
            'name'=> 'required',
            'email' => 'required',
            'password' => 'required'
            ],[
            'name.required' => 'wajib diisi',
            'email.required' => 'wajib diisi',
            'email.email' => 'contoh example@gmail.com',
            'password.required' => 'wajib diisi'
                ]);

        $data = [
            'name'->$request->name,
            'email'->$request->email,
            'password'->Hash::make($request->password)
            ];
        User::create($data);
        return redirect()->route('/login')->with('success', 'berhasil buat akun');
    }

}