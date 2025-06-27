@extends('app')

@section('content')
<div class="container container-fluid py-4" style="background: #f7f8fa;">
  <section class="content-header d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0"
      style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">
      Sucursales
    </h1>
    <button
      class="btn btn-gradient shadow-sm px-4 py-2 fw-semibold"
      data-bs-toggle="modal"
      data-bs-target="#addBranch"
      style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border-radius: 16px; border: none; box-shadow: 0 6px 18px 0 #c850c032;">
      + Agregar sucursal
    </button>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="shadow-lg rounded-4 bg-white p-0"
          style="border: none; box-shadow: 0 10px 32px 0 #1F21380A, 0 1.5px 6px 0 #C850C022;">
          <table class="table align-middle mb-0 table-borderless">
            <thead>
              <tr style="border-bottom: 1.5px solid #f1e7f7;">
                <th style="width: 8%;">ID</th>
                <th>Sucursal</th>
                <th>Estado</th>
                <th class="text-end" style="width: 20%;">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @forelse($branches as $branch)
              <tr>
                <td class="fw-bold text-secondary">{{ $branch->id }}</td>
                <td>
                  <span class="fw-medium sucursal-gradient"
                    style="font-size: 1.07rem;">{{ $branch->name }}</span>
                </td>
                <td>
                  @if($branch->status)
                  <span class="badge rounded-pill px-3 py-2"
                    style="background: #c53db4; color: #fff; font-weight:600; font-size: .98rem;">
                    Activo
                  </span>
                  @else
                  <span class="badge rounded-pill px-3 py-2"
                    style="background: #63686e; color: #fff; font-weight:600; font-size: .98rem;">
                    Inactivo
                  </span>
                  @endif
                </td>
                <td class="text-end">
                  <a href="{{ route('branch.edit', $branch->id) }}"
                    class="btn btn-link p-0 m-0 me-2"
                    title="Editar"
                    style="color:#c53db4;">
                    <i class="bi bi-pencil-square" style="font-size: 1.3rem; vertical-align: middle;"></i>
                  </a>
                  <form action="{{ route('branch.destroy', $branch->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="btn btn-link p-0 m-0"
                      title="Eliminar"
                      style="color:#c53db4;"
                      onclick="return confirm('¿Estás seguro de eliminar esta sucursal?')">
                      <i class="bi bi-trash" style="font-size: 1.3rem; vertical-align: middle;"></i>
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
    <label for="branch-name" class="form-label fw-semibold">Nombre de la sucursal</label>
    <input
      type="text"
      class="form-control"
      id="branch-name"
      name="name"
      placeholder="Ingrese el nombre"
      required>
  </div>
  <div class="modal-footer border-0">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 9px;">Cancelar</button>
    <button type="submit" class="btn btn-gradient"
      style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border: none; font-weight: 600; border-radius: 9px;">
      Guardar
    </button>
  </div>
</form>
@endcomponent

@push('styles')
<style>
  .sucursal-gradient {
    background: linear-gradient(90deg, #C850C0, #FFCC70);
    -webkit-background-clip: text;
    color: transparent;
  }

  .btn-gradient {
    background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%) !important;
    color: #fff !important;
    border: none;
    font-weight: 600;
    box-shadow: 0 6px 18px 0 #c850c032;
  }

  .table th {
    border: none !important;
    font-weight: 600;
    background: transparent;
    color: #222;
    font-size: 1.07rem;
  }

  .table td {
    border-top: none !important;
    border-bottom: 1px solid #f4f4f4 !important;
    vertical-align: middle;
    background: transparent !important;
  }

  .table thead tr {
    border-bottom: 1.5px solid #f1e7f7;
  }

  .shadow-lg {
    box-shadow: 0 10px 32px 0 #1F21380A, 0 1.5px 6px 0 #C850C022 !important;
  }

  body,
  .container-fluid {
    background: #f7f8fa !important;
  }
</style>
@endpush
@endsection