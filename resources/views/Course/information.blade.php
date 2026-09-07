@extends('layouts.app')

@section('title', $course->name)

@section('content')
    <div class="course-information-page">
        <a href="{{ route('courses.index') }}" class="course-information-back">
            <i class="fas fa-arrow-left" aria-hidden="true"></i> Volver a ofertas
        </a>

        <article class="course-information-card">
            <div class="course-information-image-wrap">
                <img src="{{ asset($offerImage) }}" alt="Imagen de {{ $course->name }}" class="offer-image-{{ $course->course_number }}">
                <span>{{ $course->course_number }}</span>
            </div>
            <div class="course-information-body">
                <span class="offer-type"><i class="fas fa-certificate" aria-hidden="true"></i>Oferta educativa SENA</span>
                <h1>{{ $course->name }}</h1>
                <p class="course-information-intro">{{ $offerDescription }}</p>
                @php
                    $technicalCourses = ['ADS-001', 'SIS-002', 'ADM-003', 'CON-004', 'LOG-008', 'AUT-009'];
                    $displayDuration = in_array($course->course_number, $technicalCourses, true)
                        ? '14 meses'
                        : ($course->duration_months ? $course->duration_months . ' meses' : 'Por definir');
                @endphp
                <div class="course-information-details">
                    <span><i class="far fa-clock" aria-hidden="true"></i><strong>Horario:</strong> {{ $course->schedule ?: $course->day }}</span>
                    <span><i class="fas fa-hourglass-half" aria-hidden="true"></i><strong>Duración:</strong> {{ $displayDuration }}</span>
                    @if ($course->trainingCenter)
                        <span><i class="fas fa-map-marker-alt" aria-hidden="true"></i><strong>Centro:</strong> {{ $course->trainingCenter->name }}</span>
                    @endif
                </div>
                <div class="course-information-learning">
                    <h2>Lo que aprenderás</h2>
                    <ul>
                        @foreach ($offerLearning as $learning)
                            <li><i class="fas fa-check" aria-hidden="true"></i>{{ $learning }}</li>
                        @endforeach
                    </ul>
                </div>
                <a class="course-information-enroll" href="{{ route('courses.enroll.form', $course) }}">
                    <i class="fas fa-user-plus" aria-hidden="true"></i> Postularme a esta oferta
                </a>
            </div>
        </article>
    </div>
@endsection