<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('auth_user')) {
            return redirect('/calc');
        }
        return view('login', [
            'page_title'       => 'Logowanie – Kalkulator Kredytowy',
            'page_description' => 'Logowanie',
            'page_header'      => '<div class="logo-icon">🏦</div>
                <span class="logo-text">Kalkulator<span>Kredytowy</span></span>',
        ]);
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('name', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            session([
                'auth_user' => $user->name,
                'auth_role' => $user->role,
            ]);
            return redirect('/calc');
        }

        return view('login', [
            'error'            => 'Nieprawidłowy login lub hasło.',
            'page_title'       => 'Logowanie – Kalkulator Kredytowy',
            'page_description' => 'Logowanie',
            'page_header'      => '<div class="logo-icon">🏦</div>
                <span class="logo-text">Kalkulator<span>Kredytowy</span></span>',
        ]);
    }

    public function logout()
    {
        session()->forget(['auth_user', 'auth_role']);
        return redirect('/login');
    }
}