@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <section class="content-header d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Sucursales</h1>
    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addBranch">Agregar sucursal</button>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-body ">
            <table class="table table-striped align-middle table-bordered" id="branchesTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sucursal</th>
                  <th>Estado</th>
                  <th class="text-end">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($branches as $branch)
                  <tr>
                    <td>{{ $branch->id }}</td>
                    <td>{{ $branch->name }}</td>
                    <td>
                      @if($branch->status)
                        <span class="badge bg-success">Activo</span>
                      @else
                        <span class="badge bg-secondary">Inactivo</span>
                      @endif
                    </td>
                    <td class="text-end">
                      <form action="{{ route('branch.destroy', $branch->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger p-0" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta sucursal?')">
                          <i class="bi bi-trash" style="font-size: 1.2rem;"></i>
                        </button>
                      </form>
                      <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-link text-warning p-0 ms-2" title="Editar">
                        <i class="bi bi-pencil-square" style="font-size: 1.2rem;"></i>
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center">No hay sucursales registradas.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
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
  <div class="form-group">
    <label for="branch-name">Nombre de la sucursal</label>
    <input 
      type="text"
      class="form-control"
      id="branch-name"
      name="name"
      placeholder="Ingrese el nombre"
      required
      >
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
</form>
@endcomponent

@if ($errors->any())
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var modal = new bootstrap.Modal(document.getElementById('addBranch'));
      modal.show();
    });
  </script>
@endif
@endsection