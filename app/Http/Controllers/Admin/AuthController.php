<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user_is_admin = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_admin' => 1
        ], $request->password);

        if($user_is_admin)
        {
            return redirect()->route('dashboard')->with('success', 'Login Successfully');
        }
        else
        {
            return redirect()->back()->with('error', 'Incorrect Credential');
        }
    }
}
