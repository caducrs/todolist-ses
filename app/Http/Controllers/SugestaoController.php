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
        $sugestoes = Sugestao::where('ativa', true)
            ->where('created_at', '>=', now()->subHours(48))
            ->get();

        return view('tarefas.index', compact('sugestoes'));
    }

    public function criarTarefa(Request $request, Sugestao $sugestao)
    {
        $request->validate([]);

        Tarefa::create([
            'id' => (string) Str::uuid(),
            'autor_id' => auth()->id(),
            'titulo' => $sugestao->titulo,
            'descricao' => $sugestao->descricao,
            'status' => 'pendente',
            'started_at' => now(),
            'deadline' => now()->addDay(),
        ]);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada a partir da sugestão!');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'titulo' => 'required|string|max:255',
                'descricao' => 'required|string',
                'ativa' => 'nullable|boolean',
            ],
            [
                'titulo.required' => 'O título é obrigatório.',
                'descricao.required' => 'A descrição é obrigatória.',
            ],
        );

        Sugestao::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'ativa' => true,
            'autor_id' => auth()->id(),
        ]);

        return back()->with('success', 'Sugestão adicionada!');
    }
}
