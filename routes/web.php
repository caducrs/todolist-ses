<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\SugestaoController;
use App\Models\Sugestao;


Route::get('/', function () {
    $sugestoes = Sugestao::with('autor')->where('ativa', true)->get();
    return view('home', compact('sugestoes'));
})->name('home');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Dashboard para usuários autenticados
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Tarefas
    Route::resource('tarefas', TarefaController::class);
    Route::get('/tarefas/cadastro', function () {
        return view('pages.cadTarefas');
    })->name('tarefas.cadastro');

    // Sugestões
    Route::get('/sugestoes/criar', function () {
        return view('pages.cadSugestao');
    })->name('sugestoes.create');

    Route::post('/sugestoes', [SugestaoController::class, 'store'])->name('sugestoes.store');
    Route::post('/sugestoes/{sugestao}/criar-tarefa', [SugestaoController::class, 'criarTarefa'])->name('sugestoes.criarTarefa');
});
