<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('AuthAdmin:admin')->only('logout');
        $this->middleware('guestAdmin:admin')->only('login_form' , 'login');
    }

    public function login_form(){
        return view('dashboard.login');
    }

    public function login()
    {

        $remember = request()->has('remember') ? true:false;

        $credentials = [
            'email' => request()->email,
            'password' => request()->password
        ];

        if (Auth::guard('admin')->attempt($credentials , $remember)){

            return redirect()->route('admin.home');
        }

        return back();

    }

    public function logout(){

        Auth::guard('admin')->logout();
        return redirect()->to('/admin/login');
    }

}
