@extends('layouts.app')

@section('content')
    <h2>Registrar</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirmar Senha:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!-- Select para escolher entre Aluno ou Professor -->
        <div>
            <label for="type">Tipo de Usuário:</label>
            <select name="type" id="type" required>
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
            </select>
            @error('type')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Registrar</button>
    </form>
@endsection
