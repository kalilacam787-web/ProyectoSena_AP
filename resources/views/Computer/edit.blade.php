@extends('layouts.app')

@section('title', 'Editar computador')

@section('content')
    {{-- Formulario de edición: old() conserva lo escrito si la validación falla. --}}
    <div class="card">
        <div class="card-body">
            <h1 class="h4">Editar computador</h1>
            <form action="{{ route('computers.update', $computer) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                {{-- PUT se simula porque los formularios HTML solo soportan GET y POST. --}}
                @csrf
                @method('PUT')
                <div class="col-md-6"><label for="number" class="form-label">Número</label><input id="number" name="number" class="form-control" value="{{ old('number', $computer->number) }}" required></div>
                <div class="col-md-6"><label for="brand" class="form-label">Marca</label><input id="brand" name="brand" class="form-control" value="{{ old('brand', $computer->brand) }}" required></div>
                <div class="col-md-4"><label for="assigned_name" class="form-label">Persona asignada</label><input id="assigned_name" name="assigned_name" class="form-control" value="{{ old('assigned_name', $computer->assigned_name) }}"></div>
                <div class="col-md-4"><label for="assigned_document" class="form-label">Documento asignado</label><input id="assigned_document" name="assigned_document" class="form-control" value="{{ old('assigned_document', $computer->assigned_document) }}"></div>
                <div class="col-md-4"><label for="assigned_email" class="form-label">Correo asignado</label><input id="assigned_email" name="assigned_email" type="email" class="form-control" value="{{ old('assigned_email', $computer->assigned_email) }}"></div>
                <div class="col-12"><label for="description" class="form-label">Descripción</label><textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $computer->description) }}</textarea></div>
                <div class="col-12"><label for="urlFoto" class="form-label">Cambiar foto</label><input id="urlFoto" type="file" name="urlFoto" class="form-control" accept="image/*"></div>
                <div class="col-12"><button class="btn btn-primary" type="submit">Guardar cambios</button><a href="{{ route('computers.index') }}" class="btn btn-outline-secondary ms-2">Cancelar</a></div>
            </form>
        </div>
    </div>
@endsection