<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.signin');
    }

    public function signup()
    {
        return view('login.signup');
    }

    public function store(Request $request)
    {
        $item = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:admins',
            'email' => 'required|email:dns|unique:admins',
            'password' => 'required|min:5'
        ]);

        $item['name'] = $request->name;
        $item['username'] = $request->username;
        $item['email'] = $request->email;
        $item['password'] = bcrypt($request->password);
        $item['created_at'] = Carbon::now();

        // dd($item);

        Admin::create($item);

        return redirect('/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }


        return back()->withErrors([
            'username' => 'Username yang dimasukkan salah',
            'password' => 'Password yang dimasukkan salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
