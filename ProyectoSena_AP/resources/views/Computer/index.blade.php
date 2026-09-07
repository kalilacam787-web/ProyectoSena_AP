@extends('layouts.app')

@section('title', 'Computadores registrados')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Computadores registrados</h1>
        <a href="{{ route('computers.create') }}" class="btn btn-primary">Registrar nuevo</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($computer->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número</th>
                            <th>Marca</th>
                            <th>Estudiante asignado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($computer as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->number }}</td>
                                <td>{{ $item->brand }}</td>
                                <td>{{ $item->assigned_name ?: 'Sin asignar' }} @if($item->assigned_document)<small class="d-block text-muted">{{ $item->assigned_document }}</small>@endif</td>
                                <td><form action="{{ route('computers.destroy', $item) }}" method="POST" onsubmit="return confirm('¿Eliminar este computador?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button></form></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No hay computadores registrados.</p>
            @endif
        </div>
    </div>
@endsection
