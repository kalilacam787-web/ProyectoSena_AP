@extends('layouts.app')

@section('title', 'Centros de formación')

@section('content')
    <div class="training-centers-page">
    <div class="d-flex justify-content-between align-items-center mb-4 gap-3 flex-wrap">
        <div>
            <h1 class="h2 mb-1">Centros de formación</h1>
            <p class="text-muted mb-0">Busca centros de formación del SENA por municipio, ciudad o dirección en el Cauca.</p>
        </div>
        <a href="{{ route('training-centers.create') }}" class="btn btn-primary">Registrar nuevo</a>
    </div>

    <form method="GET" action="{{ route('training-centers.index') }}" class="location-search-panel mb-5">
        <label for="location" class="form-label"><i class="fas fa-search me-2" aria-hidden="true"></i>Buscar ubicación</label>
        <div class="location-search-row">
            <input type="search" id="location" name="location" value="{{ $search }}" class="form-control" list="location-options" placeholder="Ejemplo: Popayán, Puerto Tejada o Santander de Quilichao" aria-label="Buscar centro por ubicación" autocomplete="off">
            <datalist id="location-options">
                @foreach ($locationOptions as $option)
                    <option value="{{ $option }}"></option>
                @endforeach
            </datalist>
            <button type="submit" class="btn btn-success"><i class="fas fa-search me-2" aria-hidden="true"></i>Buscar</button>
            @if ($search !== '')
                <a href="{{ route('training-centers.index') }}" class="btn btn-outline-light">Limpiar</a>
            @endif
        </div>
    </form>

    @if ($trainingCenters->isEmpty())
        <div class="location-search-empty">
            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
            <h2>No encontramos centros</h2>
            <p>No hay sedes que coincidan con “{{ $search }}”. Prueba con otro municipio o dirección.</p>
        </div>
    @else
        <h2 class="h3 mb-4">{{ $search !== '' ? 'Centros encontrados para “' . $search . '”' : 'Centros de formación disponibles' }}</h2>
        @foreach ($trainingCentersByLocation as $location => $centers)
            @php
                $carouselId = 'training-centers-' . str()->slug($location);
                $slides = $centers->chunk(3);
            @endphp
            <section class="training-location-group mb-5" aria-labelledby="{{ $carouselId }}-title">
                <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-3">
                    <h3 id="{{ $carouselId }}-title" class="h4 mb-0"><i class="fas fa-map-marker-alt text-success me-2" aria-hidden="true"></i>{{ $location }}</h3>
                    @if ($slides->count() > 1)
                        <span class="training-location-count">{{ $centers->count() }} centros</span>
                    @endif
                </div>
                <div id="{{ $carouselId }}" class="carousel slide training-centers-carousel" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($slides as $slideIndex => $slide)
                            <div class="carousel-item {{ $slideIndex === 0 ? 'active' : '' }}">
                                <div class="row g-4">
                                    @foreach ($slide as $center)
                                        <div class="col-md-6 col-xl-4">
                                            <article class="card h-100 border-0 shadow-sm">
                                                <div class="card-body d-flex flex-column">
                                                    <span class="text-success mb-2"><i class="fas fa-map-marker-alt me-2"></i>{{ $location }}</span>
                                                    <h2 class="h4">{{ $center->name }}</h2>
                                                    <p class="text-muted">{{ $center->location }}</p>
                                                    <h3 class="h6 text-dark mt-2">Ofertas disponibles</h3>
                                                    @if ($center->courses->isNotEmpty())
                                                        <ul class="list-unstyled small mb-3">
                                                            @foreach ($center->courses as $course)
                                                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>{{ $course->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="text-muted small">No hay ofertas asignadas.</p>
                                                    @endif
                                                    <a class="btn btn-outline-success align-self-start" target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps/search/?api=1&query={{ urlencode('SENA ' . $center->name . ' ' . $center->location) }}">
                                                        Ver ubicación <i class="fas fa-external-link-alt ms-1"></i>
                                                    </a>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($slides->count() > 1)
                        <button class="carousel-control-prev training-carousel-control" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next training-carousel-control" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    @endif
                </div>
            </section>
        @endforeach
    @endif
    </div>

@endsection
