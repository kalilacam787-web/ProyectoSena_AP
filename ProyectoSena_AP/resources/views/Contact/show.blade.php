@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Detalles del Contacto</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label"><strong>Nombre</strong></label>
                <p>{{ $contact->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Correo Electrónico</strong></label>
                <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Teléfono Fijo</strong></label>
                        <p>{{ $contact->phone_fixed ?? 'No proporcionado' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><strong>Celular</strong></label>
                        <p>{{ $contact->phone_mobile ?? 'No proporcionado' }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Mensaje</strong></label>
                <p>{{ $contact->message ?? 'Sin mensaje' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Estado</strong></label>
                <p>
                    <span class="badge bg-{{ $contact->status === 'resolved' ? 'success' : 'warning' }}">
                        {{ $contact->status === 'resolved' ? 'Resuelto' : 'Pendiente' }}
                    </span>
                </p>
            </div>

            <div class="mb-3 text-muted">
                <small><strong>Creado:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</small><br>
                <small><strong>Actualizado:</strong> {{ $contact->updated_at->format('d/m/Y H:i') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
