@extends('app')

@section('content')
<div class="container py-4">
    <section class="content-header d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Usuarios</h1>
        <a href="{{ route('users.create') }}" class="btn btn-dark">Agregar usuario</a>
    </section>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white shadow-sm rounded-4 p-0">
                    <table class="table align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 30%;">Usuario</th>
                                <th style="width: 15%;">Email</th>
                                <th style="width: 10%;">Rol</th>
                                <th style="width: 15%;">Sucursal</th>
                                <th style="width: 25%;" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->photo }}" alt="{{ $user->name }}" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                        <a href="{{ route('users.show', $user->id) }}" class="fw-normal text-decoration-underline" style="font-size: 1rem;">{{ $user->name }}</a>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @switch($user->role)
                                        @case('admin')
                                            <span class="badge bg-danger">Admin</span>
                                            @break
                                        @case('manager')
                                            <span class="badge bg-warning text-dark">Gerente</span>
                                            @break
                                        @default
                                            <span class="badge bg-primary">Empleado</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($user->branch)
                                    {{ $user->branch->name }}
                                    @else
                                    <span class="text-muted">No asignada</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-link p-0 m-0" title="Ver" style="color:#0d6efd;">
                                        <i class="bi bi-eye" style="font-size: 1.2rem;"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-link p-0 m-0" title="Editar" style="color:#ffb300;">
                                        <i class="bi bi-pencil-square" style="font-size: 1.2rem;"></i>
                                    </a>
                                    @if(auth()->id() != $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0" title="Eliminar" style="color:#d32f48;" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="bi bi-trash" style="font-size: 1.2rem;"></i>
                                        </button>
                                    </form>
                                    @else
                                    <button type="button" class="btn btn-link p-0 m-0" title="No puedes eliminar tu propio usuario" style="color:#999; cursor: not-allowed;">
                                        <i class="bi bi-trash" style="font-size: 1.2rem;"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection