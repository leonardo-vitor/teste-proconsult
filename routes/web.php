<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketResponseController;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Página inicial (redirecionar para login)
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dash.tickets');
    }

    return redirect()->route('login');
});

// Rotas de autenticação
Route::get('/cadastro', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register.do');
Route::get('/entrar', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/entrar', [AuthController::class, 'login'])->name('login.do');
Route::get('/sair', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->name('dash.')->prefix('/painel')->group(function () {
    Route::get('/chamados/page/{page}', [TicketController::class, 'index'])->name('tickets.page');
    Route::get('/chamados', [TicketController::class, 'index'])->name('tickets');

    Route::get('/chamados/novo', [TicketController::class, 'create'])->name('tickets.create')->can('create', Ticket::class);
    Route::post('/chamados/salvar', [TicketController::class, 'store'])->name('tickets.store')->can('create', Ticket::class);
    Route::get('/chamados/visualizar/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/chamados/{ticket}/respostas', [TicketResponseController::class, 'store'])->name('response.store');
    Route::post('/chamados/{ticket}/fechar', [TicketController::class, 'finalize'])->name('tickets.finalize')->can('update', TicketResponse::class);
});
