@extends('layouts.app')

@section('title', 'Registrar Centro de Formación')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('training-centers.store') }}" method="POST" class="row g-3">
                <h1 class="h4">Registrar Centro de Formación</h1>
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="location" class="form-label">Ubicación</label>
                    <input type="text" id="location" name="location" class="form-control" required>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('training-centers.index') }}" class="btn btn-outline-primary ms-2">Ver registros</a>
                    <a href="{{ url('/') }}" class="btn btn-secondary ms-2">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <h2 class="mt-4">Centros de formación registrados</h2>
    <ul class="list-group">
        @foreach ($trainingCenters as $center)
            <li class="list-group-item">
                <strong>{{ $center->name }}</strong> - {{ $center->location }}
            </li>
        @endforeach
    </ul>
@endsection