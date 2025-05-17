<!DOCTYPE html>
<html lang="pt-BR">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    .btn-slide {
        transition: all 0.3s ease;
    }

    .btn-slide:hover {
        transform: translateX(5px);
    }
</style>

<head>
    @include('layouts.head')
</head>

<body>
    @include('layouts.navBar')
    @include('layouts.header')

    <main class="container my-4">
        @yield('conteudo')
    </main>

    @include('layouts.footer')
    @include('layouts.script')
</body>

</html>
