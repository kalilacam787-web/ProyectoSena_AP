<nav class="navbar navbar-expand-lg navbar-modern sticky-top">
  <div class="container-fluid px-3">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" aria-label="Inicio SENA">
      <img src="{{ asset('imagene/Imagenes SENA/images.png') }}" alt="Logo SENA" class="sena-logo">
    </a>

    <div class="dropdown">
      <button class="btn navbar-menu-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="me-1">Menú</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end navbar-menu-dropdown">
        <li><a class="dropdown-item" href="{{ route('contacts.index') }}">Contactos</a></li>
        <li><a class="dropdown-item" href="{{ route('areas.create') }}">Áreas</a></li>
        <li><a class="dropdown-item" href="{{ route('training-centers.index') }}">Centros de formación</a></li>
        <li><a class="dropdown-item" href="{{ route('computers.index') }}">Computadores</a></li>
        <li><a class="dropdown-item" href="{{ route('courses.index') }}">Cursos</a></li>
        <li><a class="dropdown-item" href="{{ route('teachers.index') }}">Instructores</a></li>
        <li><a class="dropdown-item" href="{{ route('apprentices.index') }}">Aprendices</a></li>
        <li><a class="dropdown-item" href="{{ url('/#quienes-somos') }}">Quiénes somos</a></li>
        <li><hr class="dropdown-divider"></li>

        @auth
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
            </form>
          </li>
        @else
          <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar sesión</a></li>
          <li><a class="dropdown-item" href="{{ route('register') }}">Registrarse</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
