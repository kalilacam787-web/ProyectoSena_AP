@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Contáctanos</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">Nuevo Contacto</a>
        </div>
    </div>

    <section class="contact-information card mb-4">
        <div class="card-body">
            <h2 class="h3 mb-3">Canales de atención SENA</h2>
            <div class="row g-3">
                <div class="col-md-6"><strong>Código postal:</strong> 110231</div>
                <div class="col-md-6"><strong>Horario:</strong> 8:00 a.m. a 12:30 p.m. y 2:00 p.m. a 5:30 p.m.</div>
                <div class="col-md-6"><strong>Conmutador:</strong> <a href="tel:+576017366060">+57 601 736 6060</a></div>
                <div class="col-md-6"><strong>Línea gratuita:</strong> <a href="tel:018000910270">018000 910270</a></div>
                <div class="col-md-6"><strong>Línea anticorrupción:</strong> <a href="tel:157">157</a></div>
                <div class="col-md-6"><strong>Correo:</strong> <a href="mailto:servicioalciudadano@sena.edu.co">servicioalciudadano@sena.edu.co</a></div>
            </div>
        </div>
    </section>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Éxito!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($contacts->isNotEmpty())
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone_mobile ?: $contact->phone_fixed ?: '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $contact->status === 'resolved' ? 'success' : 'warning' }}">
                                        {{ $contact->status === 'resolved' ? 'Resuelto' : 'Pendiente' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-info">Ver</a>
                                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
