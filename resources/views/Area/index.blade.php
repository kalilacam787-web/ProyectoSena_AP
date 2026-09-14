@extends('layouts.app')

@section('title', 'Áreas registradas')

@section('content')
    {{-- Catálogo de áreas que pueden asociarse a cursos e instructores. --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Áreas registradas</h1>
        <a href="{{ route('areas.create') }}" class="btn btn-primary">Registrar nueva</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($areas->isNotEmpty())
                {{-- Se recorre la colección enviada por el controlador. --}}
                <ul class="list-group">
                    @foreach ($areas as $area)
                        <li class="list-group-item">{{ $area->name }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay áreas registradas.</p>
            @endif
        </div>
    </div>
@endsection
