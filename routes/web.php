<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SolicitationController;

// Rota inicial
Route::get('/', [ProjectController::class, 'welcome'])->name('welcome');

// Rota para a tela de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Rota para processar o registro
Route::post('/register', [RegisterController::class, 'register']);

// Rota para a página de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas para alunos e professores
Route::middleware(['auth'])->group(function () {
    Route::get('/projetos', [ProjectController::class, 'index'])->name('projects.index');
    
    // Rotas específicas para alunos
    Route::middleware('can:isAluno')->group(function () {
        Route::get('/projetos/enviar', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projetos', [ProjectController::class, 'store'])->name('projects.store');
    });

    // Rotas específicas para professores
    Route::middleware('can:isProfessor')->group(function () {
        Route::get('/projetos/aprovar', [ProjectController::class, 'approveIndex'])->name('projects.approve');
        Route::post('/projetos/{project}/aprovar', [ProjectController::class, 'approve'])->name('projects.approveProject');
    });
});

// Rota do dashboard
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->type === 'aluno') {
            return view('dashboard.aluno'); // View específica para alunos
        } elseif (auth()->user()->type === 'professor') {
            return view('dashboard.professor'); // View específica para professores
        }
    }

    // Se não estiver autenticado, redirecionar para o login
    return redirect('/login')->withErrors(['message' => 'Você precisa estar logado para acessar esta página.']);
})->middleware('auth')->name('dashboard');

// Rotas para solicitações
Route::middleware(['auth'])->group(function () {
    Route::get('/solicitacoes', [SolicitationController::class, 'index'])->name('solicitations.index');

    // Outras rotas para criar e aprovar solicitações
    Route::post('/solicitacoes', [SolicitationController::class, 'store'])->name('solicitations.store');
    Route::post('/solicitacoes/{solicitation}/aprovar', [SolicitationController::class, 'approve'])->name('solicitations.approve');
});

// Rota para visualizar projetos pendentes
Route::get('/projects/pending', [ProjectController::class, 'showPendingProjects'])->name('projects.pending');
