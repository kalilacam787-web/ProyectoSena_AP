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

    <!-- Navbar -->
    @include('includes.navbar')

    <div class="container mt-4">
        @yield('content')
    </div>

    @include('includes.footer')

    @include('includes.dependenciasbody')


</body>

</html>
