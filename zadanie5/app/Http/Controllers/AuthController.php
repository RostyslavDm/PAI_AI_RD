<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    private array $users = [
        'admin' => ['password' => 'admin123', 'role' => 'admin'],
        'user'  => ['password' => 'user123',  'role' => 'user'],
    ];

    public function showLogin()
    {
        if (session('auth_user')) {
            return redirect('/calc');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (
            isset($this->users[$username]) &&
            $this->users[$username]['password'] === $password
        ) {
            session([
                'auth_user' => $username,
                'auth_role' => $this->users[$username]['role'],
            ]);
            return redirect('/calc');
        }

        return view('login', ['error' => 'Nieprawidłowy login lub hasło.']);
    }

    public function logout()
    {
        session()->forget(['auth_user', 'auth_role']);
        return redirect('/login');
    }
}