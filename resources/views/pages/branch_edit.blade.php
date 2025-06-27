@extends('app')

@section('content')
<div class="container container-fluid py-4" style="background: #f7f8fa;">
  <section class="content-header d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0"
      style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">
      Editar Sucursal
    </h1>
    <a href="{{ route('branch') }}"
      class="btn btn-light shadow-sm fw-semibold px-4"
      style="border-radius: 13px; border: none; color: #C850C0; background: #fff;">
      ← Volver
    </a>
  </section>

  <section class="content">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-lg rounded-4 border-0"
          style="box-shadow: 0 10px 32px 0 #1F21380A, 0 2px 8px 0 #C850C022;">
          <div class="card-body p-5">
            <form action="{{ route('branch.update', $branch->id) }}" method="POST">
              @csrf
              @method('PUT')

              @if ($errors->any())
              <div class="alert alert-danger rounded-3">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              <div class="form-group mb-4">
                <label for="branch-name" class="form-label fw-semibold">Nombre de la sucursal</label>
                <input
                  type="text"
                  class="form-control form-control-lg rounded-3"
                  id="branch-name"
                  name="name"
                  placeholder="Ingrese el nombre"
                  value="{{ $branch->name }}"
                  required>
              </div>

              <div class="form-group mb-4">
                <label for="branch-status" class="form-label fw-semibold">Estado</label>
                <select class="form-select form-select-lg rounded-3" id="branch-status" name="status">
                  <option value="1" {{ $branch->status ? 'selected' : '' }}>Activo</option>
                  <option value="0" {{ !$branch->status ? 'selected' : '' }}>Inactivo</option>
                </select>
              </div>

              <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('branch') }}"
                  class="btn btn-light fw-semibold px-4"
                  style="border-radius: 11px; border: none; color: #C850C0; background: #fff;">
                  Cancelar
                </a>
                <button type="submit"
                  class="btn btn-gradient px-4 fw-semibold"
                  style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border: none; border-radius: 11px;">
                  Guardar cambios
                </button>
              </div>
            </form>
          </div>
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

  .card {
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