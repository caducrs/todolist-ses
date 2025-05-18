@extends('layouts.main')

@section('conteudo')
    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong><i class="fas fa-exclamation-triangle me-2"></i> Erro!</strong> Por favor, corrija os
                        problemas abaixo:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow rounded-4 border-0">
                    <div class="card-header bg-dark text-white rounded-top-4">
                        <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Nova Sugestão</h5>
                    </div>

                    <div class="card-body p-4 bg-light rounded-bottom-4">
                        <form method="POST" action="{{ route('sugestoes.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="titulo" class="form-label fw-bold">Título</label>
                                <input type="text" name="titulo" id="titulo"
                                    class="form-control form-control-lg @error('titulo') is-invalid @enderror"
                                    placeholder="Ex: Melhorar processo de revisão" value="{{ old('titulo') }}" required>
                                @error('titulo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label fw-bold">Descrição</label>
                                <textarea name="descricao" id="descricao" rows="5"
                                    class="form-control form-control-lg @error('descricao') is-invalid @enderror"
                                    placeholder="Descreva sua sugestão com detalhes..." required>{{ old('descricao') }}</textarea>
                                @error('descricao')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3">
                                <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 w-sm-auto text-center">
                                    <i class="fas fa-arrow-left me-1"></i> Voltar
                                </a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm hover-scale w-100 w-sm-auto">
                                    <i class="fas fa-paper-plane me-1"></i> Enviar Sugestão
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .hover-scale {
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.03);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
        }

        textarea::placeholder,
        input::placeholder {
            color: #888 !important;
            font-style: italic;
        }

    
        @media (max-width: 576px) {

            input.form-control,
            textarea.form-control {
                width: 100%;
            }
        }
    </style>
@endsection
