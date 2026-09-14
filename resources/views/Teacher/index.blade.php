@extends('layouts.app')

@section('title', 'Instructores registrados')

@section('content')
    {{-- Listado de instructores registrados, disponible para consulta administrativa. --}}
    <div class="teacher-page">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Instructores registrados</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('teachers.create') }}" class="btn btn-primary">Registrar nuevo</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($teachers->isNotEmpty())
                    {{-- La tabla se reemplaza por un mensaje cuando no hay registros. --}}
                    <table class="table table-hover align-middle mb-0">
                        <thead><tr><th>Nombre</th><th>Tipo</th><th>Documento</th><th>Correo</th><th>Código único</th></tr></thead>
                        <tbody>
                    @foreach ($teachers as $teacher)
                        <tr><td>{{ $teacher->name }}</td><td>{{ $teacher->document_type }}</td><td>{{ $teacher->document_number }}</td><td>{{ $teacher->email }}</td><td>{{ $teacher->access_code }}</td></tr>
                    @endforeach
                        </tbody>
                    </table>
            @else
                <p class="text-muted">No hay instructores registrados.</p>
            @endif
        </div>
    </div>
    </div>
@endsection
