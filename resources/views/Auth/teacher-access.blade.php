@extends('layouts.app')

@section('title', 'Acceso de instructores')

@section('content')
    {{-- Acceso protegido para instructores mediante documento y código único. --}}
    <div class="enrollment-panel access-panel">
        <span class="enrollment-kicker"><i class="fas fa-chalkboard-teacher me-2"></i>Área de instructores</span>
        <h1>Inicio de sesión para instructores</h1>
        <p class="enrollment-note">Ingresa tus datos para continuar.</p>

        <form action="{{ route('teachers.access.submit') }}" method="POST" class="row g-3">
            {{-- El controlador valida estas credenciales antes de crear la sesión. --}}
            @csrf

            <div class="col-md-4">
                <label for="document_type" class="form-label">Tipo de documento</label>
                <select id="document_type" name="document_type" class="form-select" required>
                    <option value="">Seleccionar tipo</option>
                    <option value="CC" @selected(old('document_type') === 'CC')>Cédula de ciudadanía (CC)</option>
                    <option value="PAS" @selected(old('document_type') === 'PAS')>Pasaporte</option>
                    <option value="OTRO" @selected(old('document_type') === 'OTRO')>Otro documento</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="document_number" class="form-label">Número de documento</label>
                <input type="text" id="document_number" name="document_number" class="form-control" value="{{ old('document_number') }}" required>
                @error('document_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="access_code" class="form-label">Código único del instructor</label>
                <input type="password" id="access_code" name="access_code" class="form-control" required>
                @error('access_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-2" aria-hidden="true"></i>Ingresar
                </button>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary ms-2">Volver</a>
            </div>
        </form>
    </div>
@endsection