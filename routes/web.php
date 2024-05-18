<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Página inicial (redirecionar para login)
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dash');
    }

    return redirect()->route('login');
});

// Rotas de autenticação
Route::get('/cadastro', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register.do');
Route::get('/entrar', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/entrar', [AuthController::class, 'login'])->name('login.do');
Route::get('/sair', [AuthController::class, 'logout'])->name('logout');

Route::get('/painel', function () {
    dump('area de tickets');
})->name('dash');
