@extends('app')

@section('content')
<div class="container py-4">
  <section class="content-header mb-4 d-flex justify-content-between align-items-center">
    <h1>Detalle del Usuario</h1>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver a la lista</a>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="bg-white shadow-sm rounded-4 p-4">
          <div class="row">
            <div class="col-md-6">
              <h5 class="mb-3">Información personal</h5>
              <table class="table table-borderless">
                <tr>
                  <th style="width: 30%">ID:</th>
                  <td>{{ $user->id }}</td>
                </tr>
                <tr>
                  <th>Nombre:</th>
                  <td>{{ $user->name }}</td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td>{{ $user->email }}</td>
                </tr>
                <tr>
                  <th>Sucursal:</th>
                  <td>
                    @if($user->branch)
                      {{ $user->branch->name }}
                    @else
                      <span class="text-muted">No asignada</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Estado:</th>
                  <td>
                    @if($user->status)
                      <span class="badge rounded-pill" style="background: #21844f; color: #fff; font-size: .95rem; padding: .5em 1.4em;">Activo</span>
                    @else
                      <span class="badge rounded-pill" style="background: #63686e; color: #fff; font-size: .95rem; padding: .5em 1.4em;">Inactivo</span>
                    @endif
                  </td>
                </tr>
              </table>
            </div>
            
            <div class="col-md-6">
              <h5 class="mb-3">Información de cuenta</h5>
              <table class="table table-borderless">
                <tr>
                  <th style="width: 30%">Fecha de registro:</th>
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
          
          <div class="mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar usuario</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                Eliminar usuario
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
