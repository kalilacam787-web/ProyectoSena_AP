@extends('layouts.app')

@section('title', 'Registrar Área')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('areas.store') }}" method="POST" class="row g-3">
                <h1 class="h4">Registrar Área</h1>
                @csrf

                <div class="col-12">
                    <label for="name" class="form-label">Nombre del área</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                    <a href="{{ route('areas.index') }}" class="btn btn-outline-primary mt-2 ms-2">Ver registros</a>
                    <a href="{{ url('/') }}" class="btn btn-secondary mt-2 ms-2">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <h2 class="mt-4">Áreas registradas</h2>
    <ul class="list-group">
        @foreach ($areas as $area)
            <li class="list-group-item">{{ $area->name }}</li>
        @endforeach
    </ul>
@endsection