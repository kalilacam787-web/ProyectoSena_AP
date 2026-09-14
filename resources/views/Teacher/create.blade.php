@extends('layouts.app')

@section('title', 'Registrar Instructor')

@section('content')
    {{-- Formulario administrativo para registrar un instructor y asignarlo a un área y centro. --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                <h1 class="h4">Registrar Instructor</h1>
                {{-- Protege el envío del formulario frente a solicitudes externas. --}}
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label for="document_type" class="form-label">Tipo de documento</label>
                    <select id="document_type" name="document_type" class="form-select" required>
                        <option value="">Seleccionar tipo</option>
                        <option value="CC" @selected(old('document_type') === 'CC')>Cédula de ciudadanía (CC)</option>
                        <option value="PAS" @selected(old('document_type') === 'PAS')>Pasaporte</option>
                        <option value="OTRO" @selected(old('document_type') === 'OTRO')>Otro documento</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="document_number" class="form-label">Número de documento</label>
                    <input type="text" id="document_number" name="document_number" class="form-control" value="{{ old('document_number') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="address" class="form-label">Dirección de residencia</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Número de teléfono</label>
                    <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="access_code" class="form-label">Código único del instructor</label>
                    <input type="text" id="access_code" name="access_code" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="area_id" class="form-label">Área</label>
                    <select id="area_id" name="area_id" class="form-select" required>
                        <option value="">Seleccionar área</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="training_center_id" class="form-label">Centro de Formación</label>
                    <select id="training_center_id" name="training_center_id" class="form-select" required>
                        <option value="">Seleccionar centro</option>
                        @foreach ($trainingCenters as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                        @endforeach
                    </select>
                </div>
        <br>
              <input type="file" name="urlFoto" class="form-control-file" accept="image/*">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-primary ms-2">Ver registros</a>
                    <a href="{{ url('/') }}" class="btn btn-secondary ms-2">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <h2 class="mt-4">Docentes registrados</h2>
    <ul class="list-group">
        {{-- Lista resumida para confirmar los registros existentes. --}}
        @foreach ($teachers as $teacher)
                            <li class="list-group-item">{{ $teacher->name }} - {{ $teacher->document_number }} - {{ $teacher->email }}</li>
        @endforeach
    </ul>
@endsection
