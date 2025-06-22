<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm() {
        return view('login');
    }

        public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') return redirect('/admin/dashboard');
            else return redirect('/employee/dashboard');
        }
        return back()->with('error', 'Invalid credentials');
    }

      public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
