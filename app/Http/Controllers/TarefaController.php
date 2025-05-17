<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TarefaController extends Controller
{
    // Mostra a lista de tarefas
    public function index()
    {
        $tarefas = auth()->user()->tarefas;
        return view('tarefas.index', compact('tarefas'));
    }

    // Mostra o formulário para criar nova tarefa
    public function create()
    {
        return view('tarefas.create');
    }

    // Salva a tarefa no banco e redireciona para lista
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'deadline' => 'nullable|date',
            'status' => 'nullable|in:pendente,em andamento,não feita',
        ]);

        Tarefa::create(
            array_merge($validated, [
                'id' => (string) Str::uuid(),
                'autor_id' => auth()->id(),
                'started_at' => now(),
                'status' => $validated['status'] ?? 'pendente',
            ]),
        );

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }

    // Mostra detalhes de uma tarefa específica
    public function show(Tarefa $tarefa)
    {
        $this->authorize('view', $tarefa);
        return view('tarefas.show', compact('tarefa'));
    }

    // Mostra o formulário para editar
    public function edit(Tarefa $tarefa)
    {
        $this->authorize('update', $tarefa);
        return view('tarefas.edit', compact('tarefa'));
    }

    // Atualiza a tarefa no banco e redireciona
    public function update(Request $request, Tarefa $tarefa)
    {
        $this->authorize('update', $tarefa);

        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descricao' => 'sometimes|required|string',
            'deadline' => 'nullable|date',
            'status' => 'nullable|in:pendente,em andamento,não feita',
        ]);

        $tarefa->update($validated);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    // Deleta a tarefa e redireciona
    public function destroy(Tarefa $tarefa)
    {
        $this->authorize('delete', $tarefa);
        $tarefa->delete();

        return redirect()->route('tarefas.index')->with('success', 'Tarefa deletada com sucesso!');
    }
}
