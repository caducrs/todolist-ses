<?php

namespace App\Http\Controllers;

use App\Models\Sugestao;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SugestaoController extends Controller
{
    public function index()
    {
        $sugestoes = Sugestao::where('ativa', true)->get();
        return view('tarefas.index', compact('sugestoes'));
    }

    public function criarTarefa(Request $request, Sugestao $sugestao)
    {
        Tarefa::create([
            'id' => (string) Str::uuid(),
            'autor_id' => auth()->id(),
            'titulo' => $sugestao->titulo,
            'descricao' => $sugestao->descricao,
            'status' => 'pendente',
            'started_at' => now(),
        ]);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada a partir da sugestão!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Sugestao::create($request->all());

        return back()->with('success', 'Sugestão adicionada!');
    }
}
