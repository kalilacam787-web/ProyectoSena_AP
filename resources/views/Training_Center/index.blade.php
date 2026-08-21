@extends('layouts.app')

@section('title', 'Centros de formación')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 gap-3 flex-wrap">
        <div>
            <h1 class="h2 mb-1">Centros de formación</h1>
            <p class="text-muted mb-0">Sedes oficiales del SENA en el Cauca.</p>
        </div>
        <a href="{{ route('training-centers.create') }}" class="btn btn-primary">Registrar nuevo</a>
    </div>

    <div class="row g-4 mb-5">
        @foreach ($officialCenters as $center)
            <div class="col-md-6 col-xl-4">
                <article class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <span class="text-success mb-2"><i class="fas fa-map-marker-alt me-2"></i>SENA Cauca</span>
                        <h2 class="h4">{{ $center['name'] }}</h2>
                        <p class="text-muted flex-grow-1">{{ $center['location'] }}</p>
                        <a class="btn btn-outline-success align-self-start" target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps/search/?api=1&query={{ urlencode('SENA ' . $center['name'] . ' ' . $center['location']) }}">
                            Ver ubicación <i class="fas fa-external-link-alt ms-1"></i>
                        </a>
                    </div>
                </article>
            </div>
        @endforeach
    </div>

    @if ($trainingCenters->isNotEmpty())
        <section>
            <h2 class="h3 mb-3">Centros registrados en el sistema</h2>
            <div class="list-group shadow-sm">
                @foreach ($trainingCenters as $center)
                    <div class="list-group-item">
                        <strong>{{ $center->name }}</strong>
                        <span class="text-muted d-block">{{ $center->location }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection
