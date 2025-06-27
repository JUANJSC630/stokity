@extends('app')

@section('content')
<div class="container py-4">
  <section class="content-header mb-4">
    <h1>Editar Usuario</h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="bg-white shadow-sm rounded-4 p-4">
          <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            
            <div class="form-group mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            
            <div class="form-group mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            
            <div class="form-group mb-3">
              <label for="password" class="form-label">Contraseña (dejar en blanco para mantener la actual)</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group mb-3">
              <label for="branch_id" class="form-label">Sucursal</label>
              <select class="form-control" id="branch_id" name="branch_id">
                <option value="">Seleccione una sucursal</option>
                @foreach($branches as $branch)
                <option value="{{ $branch->id }}" {{ old('branch_id', $user->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                @endforeach
              </select>
            </div>
            
            <div class="mt-4">
              <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
