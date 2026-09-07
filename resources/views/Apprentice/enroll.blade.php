@extends('layouts.app')

@section('title', 'Inscripción educativa')

@section('content')
    <div class="enrollment-panel">
        <span class="enrollment-kicker"><i class="fas fa-graduation-cap me-2"></i>Inscripción educativa</span>
        <h1>Únete a esta oferta</h1>
        <p class="enrollment-course">{{ $course->name }}</p>
        <p class="enrollment-note">Completa tus datos para solicitar tu inscripción.</p>
        <div class="enrollment-notice">
            <i class="fas fa-info-circle" aria-hidden="true"></i>
            <p>Una vez se haya postulado a uno de nuestros programas formativos no podrá inscribirse en dos o más programas. Si desea cambiar de programa, debe realizar la cancelación de la postulación antes de la fecha de pruebas de admisión.</p>
        </div>

        <form action="{{ route('courses.enroll', $course) }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-6">
                <label for="document_type" class="form-label">Tipo de documento</label>
                <select id="document_type" name="document_type" class="form-select" required>
                    <option value="">Seleccionar tipo</option>
                    @foreach (['CC' => 'C.C', 'TI' => 'Tarjeta de identidad', 'PAS' => 'Pasaporte'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('document_type') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('document_type')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-6">
                <label for="document_number" class="form-label">Número de documento</label>
                <input type="text" id="document_number" name="document_number" class="form-control" value="{{ old('document_number') }}" required>
                @error('document_number')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">Apellido</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                @error('last_name')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-12">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-12 d-flex gap-2 flex-wrap">
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-2"></i>Enviar inscripción</button>
                <a href="{{ route('courses.index') }}" class="btn btn-outline-primary">Volver a ofertas</a>
            </div>
        </form>

        <p class="enrollment-register-prompt">
            ¿No tienes una cuenta?
            <a href="{{ route('register') }}">Regístrate aquí</a>
        </p>
    </div>
@endsection