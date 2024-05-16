<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        if (Auth::guard('data_magang')->attempt(['id_pkl' => $request->id_pkl, 'password' => $request->password])) {
            return redirect('/dashboard');
        }
        else{
            return redirect('/')->with(['warning' => 'ID PKL / Password Salah']);
        }
    }

    public function proseslogout(){
        if (Auth::guard('data_magang')->check()){
            Auth::guard("")->logout();
            return redirect('/');
        }

    }
    public function prosesloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email_admin' => $request->email_admin, 'password' => $request->password])) {
            return redirect('/admin/dashboard');
        }
        else{
            return redirect('/admin')->with(['warning' => 'Email / Password Salah']);
        }
    }
    public function proseslogoutadmin(){
        if (Auth::guard('user')->check()){
            Auth::guard("")->logout();
            return redirect('/admin');
        }

    }

}
