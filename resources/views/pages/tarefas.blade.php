@extends('layouts.main')

@section('conteudo')


    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">
                <i class="bi bi-list-check text-primary me-2 fs-3"></i> Minhas Tarefas
            </h2>
            <a href="{{ route('tarefas.create') }}" class="btn-rotativo" title="Criar nova tarefa">
                <i class="bi bi-plus-circle icon-plus"></i>
                <span class="rotating-text">
                    @foreach (str_split('Criar Tarefa') as $char)
                        <span>{{ $char }}</span>
                    @endforeach
                </span>
                <i class="bi bi-journal-text icon-notepad" title="Notepad"></i>
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
            <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
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
                                <td class="text-muted small">{{ \Illuminate\Support\Str::limit($tarefa->descricao, 50) }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $cor }} fs-6 py-2 px-3 rounded-pill shadow-sm">
                                        {{ $emoji }} {{ ucfirst($tarefa->status) }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $tarefa->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-muted small">
                                    {{ $tarefa->started_at ? $tarefa->started_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="text-muted small">
                                    {{ $tarefa->deadline ? $tarefa->deadline->format('d/m/Y H:i') : '-' }}</td>
                                <td>

                                    @can('delete', $tarefa)
                                     @csrf
                                        <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Deseja excluir esta tarefa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="tooltip" title="Excluir Tarefa">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
<style>
    .btn-rotativo {
        background-color: #0d6efd;
        /* azul */
        color: #fff;
        border-radius: 8px;
        padding: 0.6rem 1.4rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        user-select: none;
    }

    .btn-rotativo:hover {
        background-color: #0b5ed7;
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.5);
        transform: scale(1.05);
    }

    .btn-rotativo i.icon-plus {
        font-size: 1.4rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .btn-rotativo:hover i.icon-plus {
        transform: rotate(20deg);
    }

    .btn-rotativo i.icon-notepad {
        font-size: 1.3rem;
        margin-left: 6px;
        color: #d1d9ff;
        flex-shrink: 0;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .btn-rotativo:hover i.icon-notepad {
        opacity: 1;
        color: #a8c0ff;
    }

    .rotating-text {
        display: flex;
        gap: 0.05em;
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        user-select: none;
    }

    .rotating-text span {
        display: inline-block;
        transform-origin: 50% 50%;
        transition: color 0.3s ease;
    }

    /* Somente animação no hover do botão */
    .btn-rotativo:hover .rotating-text span {
        animation-name: rotate-letter;
        animation-duration: 2.4s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
    }

    /* Delay individual para cada letra */
    @for ($i = 0; $i < 12; $i++)
        .btn-rotativo:hover .rotating-text span:nth-child({{ $i + 1 }}) {
            animation-delay: {{ $i * 0.2 }}s;
        }
    @endfor

    @keyframes rotate-letter {

        0%,
        20%,
        100% {
            transform: rotate(0deg);
            color: white;
            text-shadow: none;
        }

        50% {
            transform: rotate(360deg);
            color: #a8c0ff;
            text-shadow: 0 0 6px #a8c0ff;
        }
    }
</style>
