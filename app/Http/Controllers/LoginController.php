<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        
        $context = array();

        return view("login")->with($context);
    }

    public function authUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $checkUser = User::where("email", $request->email)
                     ->where("password", md5($request->password))
                     ->get();

        if ($checkUser->count() > 0) {
            
            $request->session()->regenerate();
            return redirect('/customer');
        }
        else
        {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
 
        
    }
}
