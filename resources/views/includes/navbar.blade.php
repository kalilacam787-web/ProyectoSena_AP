<nav class="navbar navbar-expand-lg navbar-modern">
  <div class="container-fluid px-3">
    {{-- Logo y enlace para regresar al inicio del sistema. --}}
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" aria-label="Inicio SENA">
      <img src="{{ asset('storage/images/images.png') }}" alt="Logo SENA" class="sena-logo">
    </a>

    <div class="d-flex align-items-center gap-2">
      <a class="btn btn-nav-action btn-nav-primary" href="{{ route('login') }}">Iniciar sesión</a>

      {{-- Menú principal con enlaces públicos y accesos según la sesión activa. --}}
      <div class="dropdown">
        <button class="btn btn-nav-action btn-nav-primary navbar-menu-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="me-1">Menú</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end navbar-menu-dropdown">
        {{-- Estas opciones solo están disponibles para usuarios autenticados. --}}
        @auth
          <li class="dropdown-header admin-menu-heading">PERFIL ADMIN</li>
          <li><a class="dropdown-item admin-menu-link" href="{{ route('admin.profile') }}"><i class="fas fa-user-shield me-2"></i>Perfil Admin</a></li>
          <li><span class="dropdown-item-text admin-menu-description">Funciones de gestión del administrador</span></li>
          <li><hr class="dropdown-divider"></li>
        @endauth
        <li><a class="dropdown-item" href="{{ route('contacts.index') }}">Contáctanos</a></li>
        <li><a class="dropdown-item" href="{{ route('training-centers.index') }}">Centros de formación</a></li>
        <li><a class="dropdown-item" href="{{ route('computers.index') }}">Computadores</a></li>
        <li><a class="dropdown-item" href="{{ route('courses.index') }}">Cursos</a></li>
        {{-- Se muestra el panel del instructor cuando existe una sesión de instructor. --}}
        @if (session('instructor_id'))
          <li><a class="dropdown-item" href="{{ route('teachers.dashboard') }}"><i class="fas fa-chalkboard-teacher me-2"></i>Panel del instructor</a></li>
        @else
          <li><a class="dropdown-item" href="{{ route('teachers.access') }}"><i class="fas fa-sign-in-alt me-2"></i>Acceso instructores</a></li>
        @endif
        <li><a class="dropdown-item" href="{{ route('apprentices.index') }}">Aprendices</a></li>
        <li><a class="dropdown-item" href="{{ url('/#quienes-somos') }}">Quiénes somos</a></li>
        <li><hr class="dropdown-divider"></li>

        {{-- El cierre de sesión se envía mediante POST por seguridad. --}}
        @auth
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
            </form>
          </li>
        @endauth
        </ul>
      </div>
    </div>
  </div>
</nav>
