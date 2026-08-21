@extends('layouts.app')

@section('title', 'Cursos registrados')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Cursos registrados</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Registrar nuevo</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($courses->isNotEmpty())
                    <table class="table table-hover align-middle mb-0">
                        <thead><tr><th>Curso</th><th>Horario</th><th>Duración</th></tr></thead>
                        <tbody>
                    @foreach ($courses as $course)
                        <tr><td>{{ $course->name ?: $course->course_number }}</td><td>{{ $course->schedule ?: $course->day }}</td><td>{{ $course->duration_months ? $course->duration_months . ' meses' : 'Pendiente' }}</td></tr>
                    @endforeach
                        </tbody>
                    </table>
            @else
                <p class="text-muted">No hay cursos registrados.</p>
            @endif
        </div>
    </div>
@endsection
