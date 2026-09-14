@extends('layouts.app')

@section('title', 'Registrar Computador')

@section('content')
    {{-- Formulario para registrar un computador y, opcionalmente, su persona asignada. --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('computers.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                {{-- Token de protección para la solicitud de creación. --}}
                @csrf

                <div class="col-md-6">
                    <label for="number" class="form-label">Número de computador</label>
                    <input type="text" id="number" name="number" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="assigned_name" class="form-label">Estudiante asignado</label>
                    <input type="text" id="assigned_name" name="assigned_name" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="assigned_document" class="form-label">Cédula del estudiante</label>
                    <input type="text" id="assigned_document" name="assigned_document" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="assigned_email" class="form-label">Correo del estudiante</label>
                    <input type="email" id="assigned_email" name="assigned_email" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="brand" class="form-label">Marca</label>
                    <input type="text" id="brand" name="brand" class="form-control" required>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Descripción del equipo</label>
                    <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                </div>
          <br>
             <input type="file" name="urlFoto" class="form-control-file" accept="image/*">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('computers.index') }}" class="btn btn-outline-primary ms-2">Ver registros</a>
                </div>
            </form>
        </div>
    </div>

    {{-- El controlador puede devolver el registro creado como mensaje de sesión. --}}
    <pre class="mt-3 bg-light p-3">{{ session('record') }}</pre>
@endsection