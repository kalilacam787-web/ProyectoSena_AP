@extends('layouts.app')

@section('title', 'Acceso a gestión de aprendices')

@section('content')
    <div class="enrollment-panel access-panel">
        <span class="enrollment-kicker"><i class="fas fa-lock me-2"></i>Área protegida</span>
        <h1>Gestión de aprendices</h1>
        <p class="enrollment-note">Ingresa tu tipo de documento, número y contraseña para continuar.</p>

        <form action="{{ route('apprentices.access') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label for="document_type" class="form-label">Tipo de documento</label>
                <select id="document_type" name="document_type" class="form-select" required>
                    <option value="">Seleccionar tipo</option>
                    <option value="CC" @selected(old('document_type') === 'CC')>C.C</option>
                    <option value="TI" @selected(old('document_type') === 'TI')>Tarjeta de identidad</option>
                    <option value="PAS" @selected(old('document_type') === 'PAS')>Pasaporte</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="document_number" class="form-label">Número de documento</label>
                <input type="text" id="document_number" name="document_number" class="form-control" value="{{ old('document_number') }}" required>
                @error('document_number')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-12">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt me-2"></i>Ingresar</button>
            </div>
        </form>
    </div>
@endsection