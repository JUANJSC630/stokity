@extends('app')

@section('content')
<div class="container">
  <section class="content-header d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Editar Sucursal</h1>
    <a href="{{ route('branch') }}" class="btn btn-secondary">Volver</a>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-body">
            <div class="card">
              <div class="card-body">
                <form action="{{ route('branch.update', $branch->id) }}" method="POST">
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
                    <label for="branch-name" class="form-label">Nombre de la sucursal</label>
                    <input
                      type="text"
                      class="form-control"
                      id="branch-name"
                      name="name"
                      placeholder="Ingrese el nombre"
                      value="{{ $branch->name }}"
                      required>
                  </div>
                  
                  <div class="form-group mb-3">
                    <label for="branch-status" class="form-label">Estado</label>
                    <select class="form-select" id="branch-status" name="status">
                      <option value="1" {{ $branch->status ? 'selected' : '' }}>Activo</option>
                      <option value="0" {{ !$branch->status ? 'selected' : '' }}>Inactivo</option>
                    </select>
                  </div>
                  
                  <div class="d-flex justify-content-end">
                    <a href="{{ route('branch') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
