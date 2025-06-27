@extends('app')

@section('content')
<div class="container container-fluid py-4" style="background: #f7f8fa;">
  <section class="content-header mb-4">
    <h1 class="fw-bold mb-0"
      style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">
      Editar Usuario
    </h1>
  </section>

  <section class="content">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="shadow-lg rounded-4 bg-white p-4"
          style="border: none; box-shadow: 0 10px 32px 0 #1F21380A, 0 1.5px 6px 0 #C850C022;">
          <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              {{ session('info') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row mb-4">
              <div class="col-md-3">
                <div class="text-center mb-3">
                  <img src="{{ $user->photo }}" alt="{{ $user->name }}"
                    class="img-fluid rounded-circle shadow"
                    style="width: 130px; height: 130px; object-fit: cover; border: 4px solid #f7e1ff;">
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label for="photo" class="form-label fw-semibold">Foto de perfil</label>
                  <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                  <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                </div>
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="name" class="form-label fw-semibold">Nombre</label>
              <input type="text" class="form-control form-control-lg rounded-3" id="name" name="name"
                value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group mb-3">
              <label for="email" class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control form-control-lg rounded-3" id="email" name="email"
                value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group mb-3">
              <label for="password" class="form-label fw-semibold">Contraseña <span class="text-muted fw-normal">(dejar en blanco para mantener la actual)</span></label>
              <input type="password" class="form-control form-control-lg rounded-3" id="password" name="password">
            </div>

            <div class="form-group mb-3">
              <label for="branch_id" class="form-label fw-semibold">Sucursal</label>
              <select class="form-select form-select-lg rounded-3" id="branch_id" name="branch_id">
                <option value="">Seleccione una sucursal</option>
                @foreach($branches as $branch)
                <option value="{{ $branch->id }}" {{ old('branch_id', $user->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group mb-3">
              <label for="role" class="form-label fw-semibold">Rol</label>
              <select class="form-select form-select-lg rounded-3" id="role" name="role" required>
                <option value="">Seleccione un rol</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Gerente</option>
                <option value="employee" {{ old('role', $user->role) == 'employee' ? 'selected' : '' }}>Empleado</option>
              </select>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
              <a href="{{ route('users.index') }}"
                class="btn btn-light fw-semibold px-4"
                style="border-radius: 11px; border: none; color: #C850C0; background: #fff;">
                Cancelar
              </a>
              <button type="submit"
                class="btn btn-gradient px-4 fw-semibold"
                style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border: none; border-radius: 11px;">
                Actualizar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

@push('styles')
<style>
  .btn-gradient {
    background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%) !important;
    color: #fff !important;
    border: none;
    font-weight: 600;
    box-shadow: 0 6px 18px 0 #c850c032;
  }

  body,
  .container-fluid {
    background: #f7f8fa !important;
  }

  .shadow-lg {
    box-shadow: 0 10px 32px 0 #1F21380A, 0 1.5px 6px 0 #C850C022 !important;
  }

  .card,
  .bg-white {
    border-radius: 1.5rem !important;
  }

  .form-control,
  .form-select {
    border-radius: 0.75rem !important;
    border: 1.5px solid #f0e6f7;
    background: #fcfbfe;
    font-size: 1.07rem;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #C850C0;
    box-shadow: 0 0 0 0.15rem #C850C033;
  }

  label {
    color: #7e57a0;
  }
</style>
@endpush
@endsection