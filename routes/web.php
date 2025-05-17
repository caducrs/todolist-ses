<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\SugestaoController;
use App\Models\Sugestao;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aqui você pode registrar as rotas da aplicação web. Essas rotas são
| carregadas pelo RouteServiceProvider e todas elas terão o middleware "web".
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $sugestoes = Sugestao::where('ativa', true)->get();
    return view('home', compact('sugestoes'));
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('tarefas', TarefaController::class);
    Route::get('/tarefas', [TarefaController::class, 'index'])->name('tarefas.index');
    Route::post('/sugestoes/{sugestao}/criar-tarefa', [SugestaoController::class, 'criarTarefa'])->name('sugestoes.criarTarefa');
    Route::post('/sugestoes', [SugestaoController::class, 'store'])->name('sugestoes.store');

Route::get('/tarefas/cadastro', function () {
    return view('pages.cadTarefas');    
})->name('tarefas.cadastro');


});
