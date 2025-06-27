@extends('app')

@section('content')
<div class="container py-4">
  <section class="content-header d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Sucursales</h1>
    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addBranch">Agregar sucursal</button>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="bg-white shadow-sm rounded-4 p-0">
          <table class="table align-middle mb-0">
            <thead class="table-dark">
              <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 45%;">Sucursal</th>
                <th style="width: 20%;">Estado</th>
                <th style="width: 30%;" class="text-end">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @forelse($branches as $branch)
              <tr>
                <td>{{ $branch->id }}</td>
                <td class="text-end">
                  <p href="#" class="fw-normal text-primary text-decoration-underline" style="font-size: 1rem;">{{ $branch->name }}</p>
                </td>
                <td>
                  @if($branch->status)
                  <span class="badge rounded-pill" style="background: #21844f; color: #fff; font-size: .95rem; padding: .5em 1.4em;">Activo</span>
                  @else
                  <span class="badge rounded-pill" style="background: #63686e; color: #fff; font-size: .95rem; padding: .5em 1.4em;">Inactivo</span>
                  @endif
                </td>
                <td class="text-end">
                  <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-link p-0 m-0" title="Editar" style="color:#ffb300;">
                    <i class="bi bi-pencil-square" style="font-size: 1.2rem;"></i>
                  </a>
                  <form action="{{ route('branch.destroy', $branch->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link p-0 m-0" title="Eliminar" style="color:#d32f48;" onclick="return confirm('¿Estás seguro de eliminar esta sucursal?')">
                      <i class="bi bi-trash" style="font-size: 1.2rem;"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-muted py-4">No hay sucursales registradas.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

@component('components.modal', [
'id' => 'addBranch',
'labelId' => 'addBranchLabel',
'title' => 'Agregar sucursal'
])
<form action="{{ route('branch.store') }}" method="POST">
  @csrf
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
      required>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
</form>
@endcomponent
@endsection