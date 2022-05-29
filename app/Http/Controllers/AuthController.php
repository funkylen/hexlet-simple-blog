<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth');
    }

    public function auth(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = 'admin';
        $password = 'password';

        if ($validated['login'] !== $login || $validated['password'] !== $password) {
            abort(401);
        }

        $request->session()->put('auth', true);

        return redirect()->route('home');
    }
}
