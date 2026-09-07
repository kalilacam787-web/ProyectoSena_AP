@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Galería de Imágenes</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('galleries.create') }}" class="btn btn-primary">Agregar Imagen</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Éxito!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($galleries->isEmpty())
        <div class="alert alert-info">
            No hay imágenes en la galería. <a href="{{ route('galleries.create') }}">Agrega una imagen</a>
        </div>
    @else
        <div class="row">
            @foreach ($galleries as $gallery)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($gallery->image_path) }}" class="card-img-top" alt="{{ $gallery->title }}" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->title }}</h5>
                            <p class="card-text">{{ Str::limit($gallery->description, 100) }}</p>
                            <span class="badge bg-{{ $gallery->is_active ? 'success' : 'secondary' }}">
                                {{ $gallery->is_active ? 'Activa' : 'Inactiva' }}
                            </span>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
