@extends('layouts.app')
 
@section('content')
    <style>
        /* Estilos gerais do formulário */
        .login-form {
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            max-width: 400px; /* Limita a largura do formulário */
            margin: 0 auto; /* Centraliza o formulário na página */
            padding: 40px 20px 20px; /* Adiciona espaçamento interno */
            border: 1px solid #ccc; /* Borda do formulário */
            border-radius: 0; /* Bordas quadradas */
            background-color: #f9f9f9; /* Cor de fundo do formulário */
            box-shadow: none; /* Sem sombra */
        }
 
        
 
        .logo img {
            margin-left: -30px;
            height: 150px;
        }
 
        h2 {
            text-align: center; /* Centraliza o título */
            margin: 20px 0; /* Espaçamento acima e abaixo do título */
            font-size: 24px; /* Tamanho do texto */
            font-weight: normal; /* Peso normal para o título */
        }
 
        div {
            margin-bottom: 20px; /* Espaçamento entre os campos */
        }
 
        label {
            display: block; /* Faz com que o label ocupe toda a largura disponível */
            margin-bottom: 5px; /* Espaçamento abaixo do label */
            font-weight: bold; /* Negrito para os labels */
        }
 
        input[type="email"],
        input[type="password"],
        select {
            width: 100%; /* Campo ocupa toda a largura disponível */
            border: none; /* Remove a borda padrão */
            border-bottom: 2px solid #ccc; /* Borda inferior */
            padding: 10px 0; /* Espaçamento interno */
            font-size: 16px; /* Tamanho da fonte */
            outline: none; /* Remove o contorno padrão */
            transition: border-color 0.3s; /* Transição suave da cor da borda */
        }
 
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        select::placeholder {
            color: #aaa; /* Cor do placeholder */
        }
 
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #007bff; /* Cor da borda ao focar */
        }
 
        button {
            width: 100%; /* Botão ocupa toda a largura disponível */
            padding: 10px; /* Espaçamento interno */
            border: none; /* Remove a borda padrão */
            border-radius: 0; /* Bordas quadradas */
            background-color: crimson;
            color: white; /* Cor do texto */
            font-size: 16px; /* Tamanho da fonte */
            cursor: pointer; /* Muda o cursor ao passar o mouse */
            margin-top: 10px; /* Espaçamento acima do botão */
        }
 
        button:hover {
            background-color: #0056b3; 
        }
 
        span {
            color: red; /* Cor para mensagens de erro */
            font-size: 12px; /* Tamanho da fonte das mensagens de erro */
        }
    </style>
 
    
 
    <h2>Entrar</h2>
 
    <form action="{{ route('login') }}" method="POST" class="login-form">
        @csrf
        <div class="logo">
            <img src="{{ asset('storage/logo_etec_pb.png') }}" alt="Logo"> <!-- Adicione aqui sua logo -->
        </div>
 
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Digite seu email" required>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
 
        <div>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>
 
        <!-- Novo campo Select para Aluno ou Professor -->
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
 
        <button type="submit">Entrar</button>
    </form>
@endsection
 