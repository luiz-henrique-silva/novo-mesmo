<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minha Aplicação')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <!-- Conteúdo do Header -->
    </header>

    <main>
        <!-- O conteúdo principal será inserido aqui -->
        @yield('content')
    </main>

    <footer>
        <!-- Conteúdo do Footer -->
    </footer>
</body>
</html>
