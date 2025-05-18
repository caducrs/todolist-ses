<style>
    @keyframes dropdownFall {
        0% {
            opacity: 0;
            transform: translateY(-30px) scaleY(0.8);
        }

        60% {
            opacity: 1;
            transform: translateY(10px) scaleY(1.05);
        }

        80% {
            transform: translateY(-5px) scaleY(0.95);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scaleY(1);
        }
    }

    .dropdown-menu {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform-origin: top center;
        overflow: hidden;
    }

    .dropdown-menu.show {
        visibility: visible;
        pointer-events: auto;
        animation: dropdownFall 0.4s forwards cubic-bezier(0.25, 1, 0.5, 1);
    }

    .dropdown-item {
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #343a40;
        color: white;
        transform: scale(1.05);
        z-index: 10;
        box-sizing: border-box;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
    <div class="container">


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="fas fa-sign-in-alt me-1"></i> Entrar
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">
                                <i class="fas fa-user-plus me-1"></i> Cadastrar
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="fas fa-user-circle me-2"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="userDropdown"
                            style="min-width: 180px;">
                            <li>
                                <a href="{{ url('/user/profile') }}" class="dropdown-item d-flex align-items-center">
                                    <i class="fas fa-user me-2"></i> Meu Perfil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tarefas.index') }}" class="dropdown-item d-flex align-items-center">
                                    <i class="fas fa-clipboard-list me-2"></i> Minhas Tarefas
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sugestoes.create') }}" class="dropdown-item d-flex align-items-center">
                                    <i class="fas fa-lightbulb me-2"></i> Adicionar Sugestão
                                </a>
                            </li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item d-flex align-items-center"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
