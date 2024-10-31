@extends('layouts.app')

@section('content')
<h1>Solicitações Pendentes</h1>

@if ($solicitations->isEmpty())
    <p>Não há solicitações pendentes.</p>
@else
    <ul>
        @foreach ($solicitations as $solicitation)
            <li>{{ $solicitation->title }} - {{ $solicitation->description }}</li>
            <form action="{{ route('solicitations.approve', $solicitation) }}" method="POST">
                @csrf
                <button type="submit">Aprovar</button>
            </form>
        @endforeach
    </ul>
@endif
@endsection
