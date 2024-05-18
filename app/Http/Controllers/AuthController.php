<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use App\Rules\Cpf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * @return View
     */
    public function showRegistrationForm(): view
    {
        return view('auth.register');
    }

    /**
     * @param StoreRegisterRequest $request
     * @return RedirectResponse
     */
    public function register(StoreRegisterRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->cpf = $request->get('cpf');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->type = $request->get('type');

        if (!$user->save()) {
            return redirect()->route('register')->with('error', 'Usuário cadastrado com sucesso!')->withInput();
        }

        return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * @return View
     */
    public function showLoginForm(): view
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dash');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Não foi possível realizar login, verifique se os dados informados estão incorretos');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
