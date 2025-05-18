@extends('layouts.main')

@section('title', 'Home')

@section('conteudo')
    <style>
        .btn-hover-slide {
            transition: transform 0.2s ease;
        }

        .btn-hover-slide:hover {
            transform: translateX(5px);
        }

        .suggestion-card {
            transition: transform 0.2s ease;
        }

        .suggestion-card:hover {
            transform: scale(1.02);
        }

        body {
            padding-top: 70px;
        }
    </style>
    <div class="text-center my-5">
        <h1 class="display-4">👋 Bem-vindo(a), {{ Auth::user()->name ?? 'Visitante' }}!</h1>
        <p class="lead">
            📋 Este é seu <strong>painel de Listas, obrigações, e etc!</strong> simples para acompanhar suas tarefas.
        </p>
        <p>
            🚀 Para acessar todas as suas tarefas e gerenciar o fluxo, clique no botão abaixo.
        </p>
        <a href="{{ route('tarefas.index') }}" class="btn btn-primary btn-hover-slide mb-4">
            Minhas Tarefas <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>

    <div class="container mb-5">
        <h3 class="text-center mb-4">💡 Sugestões para seu dia</h3>
        <div class="row">
            @forelse ($sugestoes as $sugestao)
                <div class="col-md-4 mb-3">
                    <div class="sugestao-item p-3 mb-3 border rounded shadow-sm">
                        <h3 class="mb-2">{{ $sugestao->titulo }}</h3>
                        <p class="mb-3">{{ $sugestao->descricao }}</p>
                        <small class="autor-info fw-bold text-primary d-flex align-items-center">
                            <i class="fas fa-user-circle me-2"></i>
                            Por: <span class="autor-nome ms-1">{{ $sugestao->autor->name ?? 'Usuário desconhecido' }}</span>
                        </small>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <form action="{{ route('sugestoes.criarTarefa', $sugestao) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                Adicionar essa tarefa!
                            </button>
                        </form>
                    </div>
                </div>
        </div>
    @empty
        <li class="list-group-item d-flex flex-column align-items-center justify-content-center text-center py-5"
            style="background: #f0f8ff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); transition: box-shadow 0.3s ease, background-color 0.3s ease; cursor: default;"
            onmouseover="this.style.boxShadow='0 6px 15px rgba(0,123,255,0.4)'; this.style.backgroundColor='#e6f0ff';"
            onmouseout="this.style.boxShadow='0 2px 6px rgba(0,0,0,0.1)'; this.style.backgroundColor='#f0f8ff';">
            <i class="fas fa-smile-beam fa-4x mb-3 text-primary"></i>
            <h5 class="mb-1" style="color: #0366d6; font-weight: 600;">Nenhuma sugestão disponível no momento.
            </h5>
            <small style="color: #555;">Mas não se preocupe, tenho certeza que você já está bem ocupado!</small>
        </li>
        @endforelse
    </div>
    </div>
@endsection
