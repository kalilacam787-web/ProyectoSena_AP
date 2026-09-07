@extends('layouts.app')

@section('title', 'Ofertas educativas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Ofertas educativas</h1>
    </div>

    @if ($courses->isNotEmpty())
        <div class="row g-4 educational-offers">
            @foreach ($courses as $course)
                @php
                    $offerIcons = ['fa-code', 'fa-laptop', 'fa-briefcase', 'fa-calculator', 'fa-bolt', 'fa-utensils', 'fa-pen-nib', 'fa-truck'];
                    $offerImages = [
                        'imagene/Imagenes SENA/57640 (1).jpeg',
                        'imagene/Imagenes SENA/images.jpg',
                        'imagene/Imagenes SENA/Imagen sena.jpg',
                        'imagene/Imagenes SENA/images.png',
                    ];
                    $offerIcon = $offerIcons[$loop->index % count($offerIcons)];
                    $offerImage = $offerImages[$loop->index % count($offerImages)];
                    $offerTypes = [
                        'ADS-001' => 'Carrera técnica',
                        'SIS-002' => 'Carrera técnica',
                        'ADM-003' => 'Carrera técnica',
                        'CON-004' => 'Carrera técnica',
                        'ELE-005' => 'Curso',
                        'GAS-006' => 'Curso',
                        'DIS-007' => 'Curso',
                        'LOG-008' => 'Carrera técnica',
                        'AUT-009' => 'Carrera técnica',
                    ];
                    $offerType = $offerTypes[$course->course_number] ?? 'Oferta educativa';
                    $technicalCourses = ['ADS-001', 'SIS-002', 'ADM-003', 'CON-004', 'LOG-008', 'AUT-009'];
                    $displayDuration = in_array($course->course_number, $technicalCourses, true)
                        ? '14 meses'
                        : ($course->duration_months ? $course->duration_months . ' meses' : 'Duración por definir');
                @endphp
                <div class="col-md-6 col-xl-4">
                    <article class="educational-offer offer-tone-{{ ($loop->index % 6) + 1 }}">
                        <div class="offer-image-wrap">
                            <img src="{{ asset($offerImage) }}" alt="Imagen de {{ $course->name ?: 'la oferta educativa' }}" class="offer-image offer-image-{{ $course->course_number }}">
                            <span class="offer-image-label">SENA</span>
                        </div>
                        <div class="offer-topline">
                            <span class="offer-icon"><i class="fas {{ $offerIcon }}" aria-hidden="true"></i></span>
                            <span class="offer-code">{{ $course->course_number }}</span>
                        </div>
                        <span class="offer-type"><i class="fas fa-certificate" aria-hidden="true"></i>{{ $offerType }}</span>
                        <h2>{{ $course->name ?: $course->course_number }}</h2>
                        <div class="offer-actions">
                            <a class="offer-information" href="{{ route('courses.information', $course) }}">
                                <i class="fas fa-question-circle" aria-hidden="true"></i>
                                <span>¿Qué es?</span>
                            </a>
                            <a class="offer-location" href="{{ route('training-centers.index') }}">
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                <span>Ubicación</span>
                            </a>
                        </div>
                        <div class="offer-details">
                            <span><i class="far fa-clock" aria-hidden="true"></i>{{ $course->schedule ?: $course->day }}</span>
                            <span><i class="fas fa-hourglass-half" aria-hidden="true"></i>{{ $displayDuration }}</span>
                        </div>
                        <a class="offer-enroll" href="{{ route('courses.enroll.form', $course) }}">
                            <i class="fas fa-user-plus" aria-hidden="true"></i>Postularme
                        </a>
                        <div class="offer-footer">Formación para el trabajo <i class="fas fa-arrow-right" aria-hidden="true"></i></div>
                    </article>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-offers">
            <i class="fas fa-graduation-cap" aria-hidden="true"></i>
            <p>No hay ofertas educativas registradas.</p>
        </div>
    @endif
@endsection
