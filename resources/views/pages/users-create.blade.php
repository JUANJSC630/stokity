@extends('app')

@section('content')
<div class="container py-4">
  <section class="content-header mb-4">
    <h1>Crear Usuario</h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="bg-white shadow-sm rounded-4 p-4">
          <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
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
            
            <div class="form-group mb-3">
              <label for="photo" class="form-label">Foto de perfil</label>
              <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
              <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
            </div>
            
            <div class="form-group mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            
            <div class="form-group mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group mb-3">
              <label for="branch_id" class="form-label">Sucursal</label>
              <select class="form-control" id="branch_id" name="branch_id">
                <option value="">Seleccione una sucursal</option>
                @foreach($branches as $branch)
                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group mb-3">
              <label for="role" class="form-label">Rol</label>
              <select class="form-control" id="role" name="role" required>
                <option value="">Seleccione un rol</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Gerente</option>
                <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Empleado</option>
              </select>
            </div>
            
            <div class="mt-4">
              <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
