@extends('layouts.app')

@section('content')
<div class="admin-shell">
    <div class="admin-heading">
        <span class="section-kicker">ADMINISTRADOR</span>
        <h1 class="welcome-title mb-2">Perfil de gestión</h1>
        <p class="text-muted mb-0">{{ $user->name }} · {{ $user->email }}</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-5">
            <section class="card admin-panel h-100">
                <div class="card-body p-4 p-lg-5">
                    <h2 class="h3">Datos de identificación</h2>
                    <form method="POST" action="{{ route('admin.profile.update') }}" novalidate>
                        @csrf
                        @method('PUT')
                        <label class="form-label" for="document_type">Tipo de documento</label>
                        <select id="document_type" name="document_type" class="form-select @error('document_type') is-invalid @enderror" required>
                            <option value="">Selecciona una opción</option>
                            @foreach(['CC' => 'Cédula de ciudadanía', 'TI' => 'Tarjeta de identidad', 'CE' => 'Cédula de extranjería', 'PP' => 'Pasaporte', 'NIT' => 'NIT'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('document_type', $user->document_type) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('document_type')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        <label class="form-label mt-3" for="document_number">Número del documento</label>
                        <input id="document_number" name="document_number" type="text" inputmode="numeric" pattern="[0-9]{6,15}" maxlength="15" value="{{ old('document_number', $user->document_number) }}" class="form-control @error('document_number') is-invalid @enderror" required>
                        <div id="document-error" class="field-error" role="alert">Solo se permiten números.</div>
                        @error('document_number')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        <button class="btn btn-success w-100 mt-4" type="submit"><i class="fas fa-save me-2"></i>Guardar perfil</button>
                    </form>
                </div>
            </section>
        </div>

        <div class="col-lg-7">
            <section class="card admin-panel h-100">
                <div class="card-body p-4 p-lg-5">
                    <h2 class="h3">Funciones disponibles</h2>
                    <div class="admin-actions">
                        <a href="{{ route('courses.index') }}" class="admin-action"><i class="fas fa-book"></i><span>Cursos</span><small>Registrar y consultar</small></a>
                        <a href="{{ route('apprentices.index') }}" class="admin-action"><i class="fas fa-users"></i><span>Estudiantes</span><small>Gestionar aprendices</small></a>
                        <a href="{{ route('galleries.index') }}" class="admin-action"><i class="fas fa-images"></i><span>Contenido</span><small>Actualizar información visual</small></a>
                        <a href="{{ route('contacts.index') }}" class="admin-action"><i class="fas fa-envelope"></i><span>Contáctanos</span><small>Revisar mensajes y canales</small></a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const documentInput = document.getElementById('document_number');
    const documentError = document.getElementById('document-error');
    documentInput?.addEventListener('input', () => {
        const hasLetters = /\D/.test(documentInput.value);
        documentInput.value = documentInput.value.replace(/\D/g, '');
        documentInput.classList.toggle('is-invalid', hasLetters);
        documentError.classList.toggle('show', hasLetters);
    });
</script>
@endpush
