{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #e9ecef; /* Cor de fundo da página */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Altura total da viewport */
        margin: 0;
    }

    .form-container {
        width: 400px; /* Largura fixa para o formulário */
        background-color: #f5f5f5; /* Cor clara para o formulário */
        padding: 30px;
        border-radius: 0; /* Bordas quadradas */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        text-align: center; /* Centraliza o texto dentro do formulário */
    }

    .form-title {
        color: #343a40; /* Cor do título */
        margin-bottom: 20px;
        font-family: 'Arial', sans-serif; /* Fonte do título */
        font-size: 1.5em; /* Tamanho da fonte */
    }

    .form-control {
        border: 2px solid #6c757d; /* Borda cinza */
        border-radius: 0; /* Bordas quadradas */
        transition: border-color 0.3s; /* Transição suave */
        margin-bottom: 15px; /* Espaço entre os campos */
    }

    .form-control:focus {
        border-color: #007bff; /* Cor da borda ao focar */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Sombra ao focar */
    }

    label {
        font-weight: bold; /* Negrito nas labels */
        color: #495057; /* Cor das labels */
        display: block; /* Cada label em nova linha */
        margin-bottom: 5px; /* Espaço abaixo das labels */
    }

    .btn-primary {
        background-color: #007bff; /* Cor de fundo do botão */
        border: none; /* Sem borda */
        border-radius: 0; /* Bordas quadradas */
        padding: 10px 15px; /* Espaçamento interno */
        transition: background-color 0.3s; /* Transição suave */
        width: 100%; /* Largura total */
        font-size: 1.1em; /* Tamanho da fonte do botão */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Cor do botão ao passar o mouse */
    }

    .btn-primary:active {
        background-color: #004085; /* Cor do botão ao clicar */
    }
</style>
<h1>Enviar Projeto</h1>

<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nome">Nome do Projeto:</label>
        <input type="text" class="form-control" name="title" id="nome" required>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea class="form-control" name="description" id="descricao" required></textarea>
    </div>
    <div class="form-group">
        <label for="data_inicio">Data de Início:</label>
        <input type="date" class="form-control" name="data_inicio" id="data_inicio">
    </div>
    <div class="form-group">
        <label for="data_final">Data Final:</label>
        <input type="date" class="form-control" name="data_final" id="data_final">
    </div>
    <div class="form-group">
        <label for="integrantes">Integrantes:</label>
        <textarea class="form-control" name="integrantes" id="integrantes"></textarea>
    </div>
    <div class="form-group">
        <label for="curso_id">Curso:</label>
        <select class="form-control" name="curso_id" id="curso_id">
            <option value="1">ADM</option>
            <option value="2">DS</option>
            <option value="3">LOG</option>
        </select>
    </div>
    <div class="form-group">
        <label for="professor_orientador_id">Professor Orientador:</label>
        <select class="form-control" name="professor_orientador_id" id="professor_orientador_id">
            <option value="1">ISRAEL</option>
            <option value="2">MARCEL</option>
            <option value="3">RAFAEL</option>
        </select>
    </div>
    <div class="form-group">
        <label for="link_github">Link do GitHub:</label>
        <input type="url" class="form-control" name="link_github" id="link_github">
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <input type="text" class="form-control" name="status" id="status">
    </div>
    <div class="form-group">
        <label for="documento">Documento (S/N):</label>
        <input type="text" class="form-control" name="documento" id="documento">
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar Projeto</button>
</form>
@endsection
