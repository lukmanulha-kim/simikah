<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
Use Auth;

class LoginController extends Controller
{
    public function ceklogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect ('/home');
        }
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}