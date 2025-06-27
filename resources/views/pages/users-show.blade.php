@extends('app')

@section('content')
<div class="container container-fluid py-4" style="background: #f7f8fa;">
  <section class="content-header mb-4 d-flex justify-content-between align-items-center">
    <h1 class="fw-bold mb-0"
      style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">
      Detalle del Usuario
    </h1>
    <a href="{{ route('users.index') }}"
      class="btn btn-light shadow-sm fw-semibold px-4"
      style="border-radius: 13px; border: none; color: #C850C0; background: #fff;">
      ← Volver a la lista
    </a>
  </section>

  <section class="content">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-9">
        <div class="shadow-lg rounded-4 bg-white p-4"
          style="border: none; box-shadow: 0 10px 32px 0 #1F21380A, 0 1.5px 6px 0 #C850C022;">
          <div class="row">
            <div class="col-md-3 mb-4">
              <div class="text-center">
                <img src="{{ $user->photo }}"
                  alt="{{ $user->name }}"
                  class="img-fluid rounded-circle mb-3 shadow"
                  style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #f7e1ff;">
                <h5 class="fw-bold user-gradient mb-1" style="font-size: 1.15rem;">{{ $user->name }}</h5>
                <p class="text-muted mb-0" style="font-size: .98rem;">{{ $user->email }}</p>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <h5 class="mb-3 fw-semibold" style="color:#C850C0;">Información personal</h5>
                  <table class="table table-borderless mb-0">
                    <tr>
                      <th style="width: 35%">ID:</th>
                      <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                      <th>Email:</th>
                      <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                      <th>Sucursal:</th>
                      <td>
                        @if($user->branch)
                        <span class="user-gradient">{{ $user->branch->name }}</span>
                        @else
                        <span class="text-muted">No asignada</span>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th>Rol:</th>
                      <td>
                        @switch($user->role)
                        @case('admin')
                        <span class="badge rounded-pill px-3 py-2"
                          style="background: #dc3545; color: #fff; font-size: .97rem;">Administrador</span>
                        @break
                        @case('manager')
                        <span class="badge rounded-pill px-3 py-2"
                          style="background: #ffc107; color: #7A5100; font-size: .97rem;">Encargado</span>
                        @break
                        @default
                        <span class="badge rounded-pill px-3 py-2"
                          style="background: #63686e; color: #fff; font-size: .97rem;">Vendedor</span>
                        @endswitch
                      </td>
                    </tr>
                    <tr>
                      <th>Estado:</th>
                      <td>
                        @if($user->status)
                        <span class="badge rounded-pill px-3 py-2"
                          style="background: #c53db4; color: #fff; font-size: .97rem;">Activo</span>
                        @else
                        <span class="badge rounded-pill px-3 py-2"
                          style="background: #63686e; color: #fff; font-size: .97rem;">Inactivo</span>
                        @endif
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-6">
                  <h5 class="mb-3 fw-semibold" style="color:#C850C0;">Información de cuenta</h5>
                  <table class="table table-borderless mb-0">
                    <tr>
                      <th style="width: 45%">Fecha de registro:</th>
                      <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                      <th>Última actualización:</th>
                      <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                      <th>Último acceso:</th>
                      <td>
                        @if($user->last_login)
                        {{ \Carbon\Carbon::parse($user->last_login)->format('d/m/Y H:i') }}
                        @else
                        <span class="text-muted">Nunca</span>
                        @endif
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-4 d-flex flex-wrap gap-2">
            <a href="{{ route('users.edit', $user->id) }}"
              class="btn btn-gradient fw-semibold px-4"
              style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border-radius: 11px;">
              Editar usuario
            </a>
            @if(auth()->id() != $user->id)
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="btn btn-light fw-semibold px-4"
                style="border-radius: 11px; border:none; color:#dc3545; background:#fff;"
                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                Eliminar usuario
              </button>
            </form>
            @else
            <button type="button"
              class="btn btn-light fw-semibold px-4"
              disabled
              style="border-radius: 11px; border:none; color:#bbb; background:#fff;"
              title="No puedes eliminar tu propio usuario">
              Eliminar usuario
            </button>
            <span class="text-danger d-block mt-2">No puedes eliminar tu propio usuario mientras estás usando el sistema</span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@push('styles')
<style>
  .user-gradient {
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
    font-size: 1.04rem;
  }

  .table td {
    border-top: none !important;
    vertical-align: middle;
    background: transparent !important;
    color: #39304a;
    font-size: 1.04rem;
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