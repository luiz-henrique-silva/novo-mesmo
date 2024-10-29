@extends('layouts.app')

@section('content')
<style>
    /* Seu CSS existente */
</style>

<h1>Enviar Projeto</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nome">Nome do Projeto:</label>
        <input type="text" class="form-control" name="title" id="nome" required>
    </div>
    <!-- Continue com os outros campos do formulário -->
    <button type="submit" class="btn btn-primary">Cadastrar Projeto</button>
</form>
@endsection
