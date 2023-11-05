<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(){
        //untuk memeriksa apakah user sudah login atau belum
        if(Auth::check()){
            return redirect("home");
        } else {
            return view("login");
        }
    }

    public function actionLogin(Request $request){
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if(Auth::attempt($data)){
            $user = Auth::user();

            if($user->active){
                return redirect('home');
            } else {
                Auth::logout();
                Session::flash('error','Akun Anda belum diverifikasi. SIlahkan cek email Anda');
                return redirect('/');
            }
        } else {
            Session::flash('error','Email atau password salah');
            return redirect('/');
        }
    }

    public function actionLogout(){
        //untuk meghaous sessuin yang aktif
        //setelah logout akan diarahkan kembali ke form login

        Auth::logout();
        return redirect('/');
    }
}
