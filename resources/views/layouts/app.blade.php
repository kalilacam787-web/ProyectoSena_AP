<!doctype html>
<html lang="en">
<head>
    {{-- Configuración común del documento y archivos CSS externos. --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin_Sena</title>

    @include('includes.dependencias')

</head>

<body>

    {{-- La barra de navegación se muestra en todas las páginas. --}}
    @include('includes.navbar')

    {{-- El botón permite volver a la página anterior, excepto en el inicio. --}}
    @if (request()->path() !== '/')
        <button type="button" class="back-button" onclick="window.history.length > 1 ? window.history.back() : window.location.href='{{ url('/') }}'" aria-label="Volver a la página anterior" title="Volver">
            <i class="fas fa-arrow-left" aria-hidden="true"></i>
            <span>Volver</span>
        </button>
    @endif

    {{-- Cada vista hija inserta aquí su contenido mediante @section('content'). --}}
    <main class="app-content container-fluid mt-4">
        @yield('content')
    </main>

    {{-- Elementos compartidos que aparecen al final de todas las páginas. --}}
    @include('includes.footer')

    @include('includes.dependenciasbody')
    @stack('scripts')


</body>

</html>
