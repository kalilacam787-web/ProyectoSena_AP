<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin_Sena</title>

    @include('includes.dependencias')

</head>

<body>

    @if (request()->path() === '/')
        @include('includes.navbar')
    @endif

    @if (request()->path() !== '/')
        <button type="button" class="back-button" onclick="window.history.length > 1 ? window.history.back() : window.location.href='{{ url('/') }}'" aria-label="Volver a la página anterior" title="Volver">
            <i class="fas fa-arrow-left" aria-hidden="true"></i>
            <span>Volver</span>
        </button>
    @endif

    <main class="app-content container-fluid mt-4">
        @yield('content')
    </main>

    @include('includes.footer')

    @include('includes.dependenciasbody')
    @stack('scripts')


</body>

</html>
