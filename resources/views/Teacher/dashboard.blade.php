@extends('layouts.app')

@section('title', 'Panel del instructor')

@section('content')
    {{-- Panel privado del instructor autenticado. --}}
    <div class="instructor-dashboard">
        <div class="instructor-dashboard-heading">
            <span class="instructor-kicker"><i class="fas fa-chalkboard-teacher me-2" aria-hidden="true"></i>Área de instructor</span>
            <h1>Bienvenido, {{ $teacher->name }}</h1>
            <p>Gestiona la información académica y los recursos del centro de formación.</p>
        </div>

        <button type="button" class="instructor-personal-button" data-bs-toggle="modal" data-bs-target="#personalInformationModal">
            <i class="fas fa-id-card" aria-hidden="true"></i>
            <span><strong>Información personal</strong><small>Ver mis datos de instructor</small></span>
            <i class="fas fa-chevron-right" aria-hidden="true"></i>
        </button>

        {{-- Modal con los datos personales y relaciones del instructor. --}}
        <div class="modal fade" id="personalInformationModal" tabindex="-1" aria-labelledby="personalInformationTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content instructor-personal-modal">
                    <div class="modal-header">
                        <h2 class="modal-title" id="personalInformationTitle"><i class="fas fa-user-circle me-2" aria-hidden="true"></i>Información personal</h2>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="personal-information-grid">
                            <div><strong>Nombre</strong><span>{{ $teacher->name }}</span></div>
                            <div><strong>Tipo de documento</strong><span>{{ $teacher->document_type ?: 'Sin registrar' }}</span></div>
                            <div><strong>Número de documento</strong><span>{{ $teacher->document_number ?: 'Sin registrar' }}</span></div>
                            <div><strong>Correo</strong><span>{{ $teacher->email ?: 'Sin registrar' }}</span></div>
                            <div><strong>Teléfono</strong><span>{{ $teacher->phone ?: 'Sin registrar' }}</span></div>
                            <div><strong>Dirección de residencia</strong><span>{{ $teacher->address ?: 'Sin registrar' }}</span></div>
                            <div><strong>Centro de formación</strong><span>{{ $teacher->trainingCenter->name ?? 'Sin asignar' }}</span></div>
                            <div><strong>Área</strong><span>{{ $teacher->area->name ?? 'Sin asignar' }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Accesos rápidos a los módulos que puede consultar el instructor. --}}
        <div class="instructor-actions-grid" aria-label="Servicios del instructor">
            <a href="{{ route('apprentices.index') }}" class="instructor-action">
                <i class="fas fa-users" aria-hidden="true"></i><strong>Aprendices</strong><span>Consultar y gestionar información.</span>
            </a>
            <a href="{{ route('courses.index') }}" class="instructor-action">
                <i class="fas fa-graduation-cap" aria-hidden="true"></i><strong>Ofertas educativas</strong><span>Consultar programas disponibles.</span>
            </a>
            <a href="{{ route('computers.index') }}" class="instructor-action">
                <i class="fas fa-laptop" aria-hidden="true"></i><strong>Computadores</strong><span>Consultar el inventario.</span>
            </a>
            <a href="{{ route('training-centers.index') }}" class="instructor-action">
                <i class="fas fa-building" aria-hidden="true"></i><strong>Centros de formación</strong><span>Consultar sedes y ubicaciones.</span>
            </a>
            <a href="{{ route('teachers.index') }}" class="instructor-action">
                <i class="fas fa-chalkboard-teacher" aria-hidden="true"></i><strong>Instructores</strong><span>Consultar instructores registrados.</span>
            </a>
        </div>
    </div>
@endsection