<nav>
    <!-- Verificar se o usuário está autenticado -->
    @if(auth()->check())
        <ul>
            <li>Bem-vindo, {{ auth()->user()->name }}</li>
            <!-- Exibir mais opções baseadas no usuário logado -->
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    @else
        <ul>
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Registrar</a></li>
        </ul>
    @endif
</nav>
