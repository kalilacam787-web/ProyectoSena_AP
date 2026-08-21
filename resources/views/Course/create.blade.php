@extends('layouts.app')

@section('title', 'Registrar Curso')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST" class="row g-3">
                <h1 class="h4">Registrar Curso</h1>
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre del curso</label>
                    <select id="name" name="name" class="form-select" required>
                        <option value="">Seleccionar curso</option>
                        @foreach (['Cocina', 'Inglés', 'Francés', 'Costura', 'Mecánica', 'Electricidad'] as $courseName)
                            <option value="{{ $courseName }}">{{ $courseName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="schedule" class="form-label">Horario disponible</label>
                    <input type="text" id="schedule" name="schedule" class="form-control" placeholder="Lunes a viernes, 8:00 a. m. - 12:00 m." required>
                </div>

                <div class="col-md-6">
                    <label for="duration_months" class="form-label">Duración (meses)</label>
                    <input type="number" id="duration_months" name="duration_months" class="form-control" min="1" max="4" required>
                </div>

                <div class="col-md-6">
                    <label for="area_id" class="form-label">Área</label>
                    <select id="area_id" name="area_id" class="form-select">
                        <option value="">Seleccionar área</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="training_center_id" class="form-label">Centro de Formación</label>
                    <select id="training_center_id" name="training_center_id" class="form-select">
                        <option value="">Seleccionar centro</option>
                        @foreach ($training_centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-primary ms-2">Ver registros</a>
                    <a href="{{ url('/') }}" class="btn btn-secondary ms-2">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <h2 class="mt-4">Cursos registrados</h2>
    <ul class="list-group">
        @foreach ($courses as $course)
            <li class="list-group-item">ID: {{ $course->id }} - Número: {{ $course->course_number }} - Día: {{ $course->day }} - Área: {{ $course->area_id }} - Centro: {{ $course->training_center_id }}</li>
        @endforeach
    </ul>
@endsection
