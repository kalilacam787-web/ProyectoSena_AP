@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    @if($galleries && count($galleries) > 0)
    <div id="galleryCarousel" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="8000" data-bs-wrap="true" data-bs-pause="false">
        <div class="carousel-inner">
            @foreach($galleries as $key => $gallery)
                @php
                    $imagePath = is_object($gallery) ? $gallery->image_path : $gallery['image_path'];
                    $imageTitle = is_object($gallery) ? ($gallery->title ?? '') : ($gallery['title'] ?? '');
                    $imageDescription = is_object($gallery) ? ($gallery->description ?? '') : ($gallery['description'] ?? '');
                @endphp
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ asset($imagePath) }}" class="d-block w-100 gallery-image" alt="{{ $imageTitle ?: 'Imagen' }}">
                    @if(trim((string) $imageTitle) !== '' || trim((string) $imageDescription) !== '')
                        <div class="carousel-caption d-none d-md-block">
                            @if(trim((string) $imageTitle) !== '')
                                <h5 class="display-5">{{ $imageTitle }}</h5>
                            @endif
                            @if(trim((string) $imageDescription) !== '')
                                <p class="lead">{{ $imageDescription }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
    @endif

    <!-- Contenido Principal -->
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="display-4 mb-4 welcome-title">Bienvenido al SENA</h1>
            <p class="lead welcome-subtitle mb-4">
                Sistema de gestión integral para centros de formación SENA
            </p>
        </div>

        <div id="quienes-somos" class="card border-0 shadow-sm mb-5 bg-light about-section">
            <div class="card-body p-5">
                <span class="section-kicker">Nuestra identidad</span>
                <h2 class="text-center mb-4 about-title">¿Quiénes somos?</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-4 rounded-3 bg-white h-100 about-panel">
                            <div class="about-icon"><i class="fas fa-bullseye" aria-hidden="true"></i></div>
                            <h4 class="text-success mb-3">Misión</h4>
                            <p class="mb-0">Facilitar la gestión administrativa y académica de los aprendices, docentes y recursos del SENA para fortalecer la formación técnica y profesional.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 rounded-3 bg-white h-100 about-panel">
                            <div class="about-icon"><i class="fas fa-eye" aria-hidden="true"></i></div>
                            <h4 class="text-success mb-3">Visión</h4>
                            <p class="mb-0">Ser una plataforma innovadora y eficiente que apoye la organización, seguimiento y crecimiento de la comunidad formativa del SENA.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secciones principales -->
        <div class="row g-4 mb-5 welcome-information">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm function-card">
                    <div class="card-body text-center">
                        <i class="fas fa-book fa-3x text-success mb-3"></i>
                        <h3 class="card-title">Ofertas educativas</h3>
                        <p class="card-text">Explora cursos y carreras técnicas de diferentes áreas de formación.</p>
                        <a href="{{ route('courses.index') }}" class="btn btn-success">Ver ofertas</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm function-card">
                    <div class="card-body text-center">
                        <i class="fas fa-laptop fa-3x text-info mb-3"></i>
                        <h3 class="card-title">Centros de formación</h3>
                        <p class="card-text">Consulta cinco sedes oficiales del SENA en el departamento del Cauca.</p>
                        <a href="{{ route('training-centers.index') }}" class="btn btn-success">Ver centros</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm function-card">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">Gestión de Aprendices</h3>
                        <p class="card-text">Consulta programa, computador, centro de formación y datos personales.</p>
                        <a href="{{ route('apprentices.index') }}" class="btn btn-primary">Ver aprendices</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contacto -->
        <div class="card bg-light border-0 mb-5">
            <div class="card-body p-5 text-center">
                <h2 class="mb-4">¿Tienes preguntas o comentarios?</h2>
                <p class="lead mb-4">Nos encantaría saber de ti. Completa el formulario de contacto y nos pondremos en contacto pronto.</p>
                <a href="{{ route('contacts.create') }}" class="btn btn-lg btn-primary">Enviar Mensaje</a>
            </div>
        </div>

        <!-- Información -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <h3 class="mb-3">Características Principales</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0 py-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <span class="fs-5">Gestión integral de aprendices</span>
                    </li>
                    <li class="list-group-item border-0 py-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <span class="fs-5">Cursos y carreras técnicas</span>
                    </li>
                    <li class="list-group-item border-0 py-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <span class="fs-5">Inventario de computadores</span>
                    </li>
                    <li class="list-group-item border-0 py-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <span class="fs-5">Gestión de instructores</span>
                    </li>
                    <li class="list-group-item border-0 py-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <span class="fs-5">Sistema de contactos</span>
                    </li>
                    <li class="list-group-item border-0 py-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <span class="fs-5">Galería de imágenes</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="quick-access-image mb-4">
                    <img src="{{ asset('imagene/Imagenes SENA/64de9687d6cea.r_d.283-350-0.jpeg') }}" alt="Comunidad SENA en formación">
                </div>
                <h3 class="mb-3">Acceso Rápido</h3>
                <div class="btn-group-vertical w-100" role="group">
                    @auth
                        <a href="{{ route('contacts.index') }}" class="btn btn-outline-primary btn-lg text-start">
                            <i class="fas fa-envelope me-2"></i> Mis Mensajes
                        </a>
                        <a href="{{ route('galleries.index') }}" class="btn btn-outline-primary btn-lg text-start">
                            <i class="fas fa-images me-2"></i> Galería
                        </a>
                        <a href="{{ route('apprentices.index') }}" class="btn btn-outline-primary btn-lg text-start">
                            <i class="fas fa-users me-2"></i> Aprendices
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i> Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
