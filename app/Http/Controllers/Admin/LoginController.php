<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\MainController as Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        
        $data = ["login" => $request->login,
        "password" => $request->password];

        if(Auth::guard('admin')->attempt($data,)){    
            return redirect()->route('admin.request.index');
        }
        
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
