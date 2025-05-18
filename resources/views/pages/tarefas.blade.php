@extends('layouts.main')

@section('conteudo')
    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h2 class="fw-bold text-dark d-flex align-items-center gap-2 mb-0">
                <i class="bi bi-list-check text-primary fs-3"></i> Minhas Tarefas
            </h2>
            <a href="{{ route('tarefas.create') }}" class="btn btn-primary rounded-pill px-4 py-2" title="Criar nova tarefa">
                <i class="bi bi-plus-circle me-2 fs-5"></i> Criar Tarefa
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (empty($tarefas) || $tarefas->isEmpty())
            <div class="alert alert-info text-center py-5 shadow-sm rounded">
                <i class="bi bi-info-circle fs-4 me-2"></i> Nenhuma tarefa encontrada.
            </div>
        @else
     
            <div class="table-responsive shadow-sm rounded-4 overflow-hidden d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th class="text-start">Título</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Criada em</th>
                            <th>Início</th>
                            <th>Prazo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tarefas as $tarefa)
                            @php
                                $map = [
                                    'pendente' => ['warning', '⏳'],
                                    'em andamento' => ['info', '🚧'],
                                    'não feita' => ['secondary', '❌'],
                                    'concluída' => ['success', '✅'],
                                ];
                                [$cor, $emoji] = $map[$tarefa->status] ?? ['dark', '❓'];
                            @endphp
                            <tr class="hoverable-row transition text-center">
                                <td class="text-start fw-semibold text-dark">{{ $tarefa->titulo }}</td>
                                <td class="text-muted small">{{ \Illuminate\Support\Str::limit($tarefa->descricao, 50) }}</td>
                                <td>
                                    <span class="badge bg-{{ $cor }} fs-6 py-2 px-3 rounded-pill shadow-sm">
                                        {{ $emoji }} {{ ucfirst($tarefa->status) }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $tarefa->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-muted small">{{ $tarefa->started_at ? $tarefa->started_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="text-muted small">{{ $tarefa->deadline ? $tarefa->deadline->format('d/m/Y H:i') : '-' }}</td>
                                <td class="d-flex justify-content-center gap-2 flex-wrap">
                                    <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST"
                                        onsubmit="return confirm('Marcar tarefa como concluída? Ela será removida.')"
                                        class="d-inline-block me-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-success btn-sm d-flex align-items-center justify-content-center p-0"
                                            style="width: 38px; height: 38px;" title="Marcar como feita"
                                            data-bs-toggle="tooltip">
                                            <i class="bi bi-check2-circle fs-5"></i>
                                        </button>
                                    </form>

                                    @can('update', $tarefa)
                                        <button type="button"
                                            onclick="location.href='{{ route('tarefas.edit', $tarefa->id) }}'"
                                            class="btn btn-warning btn-sm d-flex align-items-center justify-content-center p-0"
                                            style="width: 38px; height: 38px;" title="Editar Tarefa" data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil-square fs-5"></i>
                                        </button>
                                    @endcan

                                    @can('delete', $tarefa)
                                        <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST"
                                            onsubmit="return confirm('Deseja excluir esta tarefa?')"
                                            class="d-inline-block ms-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm d-flex align-items-center justify-content-center p-0"
                                                style="width: 38px; height: 38px;" title="Excluir Tarefa"
                                                data-bs-toggle="tooltip">
                                                <i class="bi bi-trash3-fill fs-5"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

    
            <div class="d-md-none">
                @foreach ($tarefas as $tarefa)
                    @php
                        $map = [
                            'pendente' => ['warning', '⏳'],
                            'em andamento' => ['info', '🚧'],
                            'não feita' => ['secondary', '❌'],
                            'concluída' => ['success', '✅'],
                        ];
                        [$cor, $emoji] = $map[$tarefa->status] ?? ['dark', '❓'];
                    @endphp

                    <div class="card shadow-sm mb-3">
                        <div class="card-body p-3">
                            <h5 class="card-title fw-semibold mb-1">{{ $tarefa->titulo }}</h5>
                            <p class="card-text text-muted small mb-2">{{ $tarefa->descricao }}</p>
                            <div class="mb-2">
                                <span class="badge bg-{{ $cor }} rounded-pill px-3 py-2 fs-6">
                                    {{ $emoji }} {{ ucfirst($tarefa->status) }}
                                </span>
                            </div>

                            <ul class="list-unstyled small text-muted mb-3">
                                <li><strong>Criada em:</strong> {{ $tarefa->created_at->format('d/m/Y H:i') }}</li>
                                <li><strong>Início:</strong> {{ $tarefa->started_at ? $tarefa->started_at->format('d/m/Y H:i') : '-' }}</li>
                                <li><strong>Prazo:</strong> {{ $tarefa->deadline ? $tarefa->deadline->format('d/m/Y H:i') : '-' }}</li>
                            </ul>

                            <div class="d-flex justify-content-between gap-2 flex-wrap">
                                <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST"
                                    onsubmit="return confirm('Marcar tarefa como concluída? Ela será removida.')"
                                    class="flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-success w-100" title="Marcar como feita">
                                        <i class="bi bi-check2-circle me-1"></i> Concluir
                                    </button>
                                </form>

                                @can('update', $tarefa)
                                    <button type="button"
                                        onclick="location.href='{{ route('tarefas.edit', $tarefa->id) }}'"
                                        class="btn btn-warning flex-grow-1"
                                        title="Editar Tarefa">
                                        <i class="bi bi-pencil-square me-1"></i> Editar
                                    </button>
                                @endcan

                                @can('delete', $tarefa)
                                    <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST"
                                        onsubmit="return confirm('Deseja excluir esta tarefa?')"
                                        class="flex-grow-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100" title="Excluir Tarefa">
                                            <i class="bi bi-trash3-fill me-1"></i> Excluir
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
