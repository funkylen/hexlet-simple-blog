<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if (session('auth') === true) {
            return redirect($request->to ?? route('home'));
        }

        return view('auth');
    }

    public function auth(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = config('auth.simple_auth.login');
        $password = config('auth.simple_auth.password');

        if ($validated['login'] !== $login || $validated['password'] !== $password) {
            abort(401);
        }

        $request->session()->put('auth', true);

        return back();
    }
}
