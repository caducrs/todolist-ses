@extends('layouts.main')

@section('conteudo')
    <style>
     
        .form-container {
            max-width: 480px;
            margin: 2rem auto;
            padding: 2rem 2.5rem;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 14px 30px rgba(0, 123, 255, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            animation: fadeInUp 0.8s ease forwards;
        }

   
        .form-container h1 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1.8rem;
            color: #0d47a1;
            letter-spacing: 1px;
            text-align: center;
            text-shadow: 0 1px 3px rgba(13, 71, 161, 0.3);
        }

        /* Validation errors box */
        .error-box {
            background-color: #fdecea;
            border: 1px solid #f5c2c0;
            color: #b00020;
            padding: 1rem 1.3rem;
            border-radius: 8px;
            margin-bottom: 1.8rem;
            box-shadow: 0 0 8px rgba(176, 0, 32, 0.2);
            animation: shake 0.4s ease;
        }

        .error-box ul {
            list-style-type: disc;
            padding-left: 1.2rem;
            margin: 0;
        }

      
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #0d47a1;
            user-select: none;
        }

        input[type="text"],
        input[type="datetime-local"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 2px solid #cfd8dc;
            font-size: 1rem;
            color: #374151;
            font-weight: 500;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            resize: vertical;
        }

        input[type="text"]:focus,
        input[type="datetime-local"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #0d47a1;
            box-shadow: 0 0 8px #0d47a1aa;
            animation: pulseBorder 1.2s infinite ease-in-out;
        }

    
        button[type="submit"] {
            display: block;
            width: 100%;
            background: linear-gradient(90deg, #0d47a1 0%, #1976d2 50%, #0d47a1 100%);
            background-size: 200% 100%;
            color: white;
            font-weight: 700;
            padding: 0.85rem 0;
            font-size: 1.2rem;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(13, 71, 161, 0.3);
            transition: background-position 0.5s ease, transform 0.2s ease, box-shadow 0.3s ease;
            user-select: none;
        }

        button[type="submit"]:hover {
            background-position: 100% 0;
            box-shadow: 0 12px 28px rgba(25, 118, 210, 0.7), 0 0 15px #90caf9;
            transform: scale(1.05);
        }

        button[type="submit"]:active {
            background-position: 100% 0;
            transform: scale(0.98);
            box-shadow: 0 6px 12px rgba(13, 71, 161, 0.8);
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseBorder {

            0%,
            100% {
                border-color: #0d47a1;
                box-shadow: 0 0 8px #0d47a1aa;
            }

            50% {
                border-color: #1e6bef;
                box-shadow: 0 0 12px #1e6befcc;
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-6px);
            }

            75% {
                transform: translateX(6px);
            }
        }
    </style>

    <div class="form-container">
        <h1>{{ isset($tarefa) ? 'Editar Tarefa' : 'Cadastrar Nova Tarefa' }}</h1>

   
        @if ($errors->any())
            <div class="error-box" role="alert" aria-live="assertive">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ isset($tarefa) ? route('tarefas.update', $tarefa->id) : route('tarefas.store') }}" method="POST"
            class="space-y-6" novalidate>
            @csrf
            @if (isset($tarefa))
                @method('PUT')
            @endif

            <div>
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $tarefa->titulo ?? '') }}"
                    required placeholder="Digite o título da tarefa" autocomplete="off" aria-required="true" />
            </div>

            <div>
                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" rows="4" required placeholder="Descreva sua tarefa"
                    aria-required="true">{{ old('descricao', $tarefa->descricao ?? '') }}</textarea>
            </div>

            <div>
                <label for="deadline">Prazo (opcional)</label>
                <input type="datetime-local" name="deadline" id="deadline"
                    value="{{ old('deadline', isset($tarefa) && $tarefa->deadline ? $tarefa->deadline->format('Y-m-d\TH:i') : '') }}"
                    aria-required="false" />
            </div>

            <div>
                <label for="status">Status</label>
                <select name="status" id="status" aria-required="true">
                    <option value="pendente" {{ old('status', $tarefa->status ?? '') == 'pendente' ? 'selected' : '' }}>
                        Pendente</option>
                    <option value="em andamento"
                        {{ old('status', $tarefa->status ?? '') == 'em andamento' ? 'selected' : '' }}>Em andamento</option>
                    <option value="não feita" {{ old('status', $tarefa->status ?? '') == 'não feita' ? 'selected' : '' }}>
                        Não feita</option>
                </select>
            </div>

            <button type="submit" aria-label="{{ isset($tarefa) ? 'Atualizar tarefa' : 'Cadastrar tarefa' }}">
                {{ isset($tarefa) ? 'Atualizar Tarefa' : 'Cadastrar Tarefa' }}
            </button>
        </form>
    </div>
@endsection
