@extends('app')

@section('content')
<div class="container container-fluid py-4" style="background: #f7f8fa;">
    <section class="content-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0"
            style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">
            Usuarios
        </h1>
        <a href="{{ route('users.create') }}"
            class="btn btn-gradient shadow-sm px-4 py-2 fw-semibold"
            style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border-radius: 16px; border: none; box-shadow: 0 6px 18px 0 #c850c032;">
            + Agregar usuario
        </a>
    </section>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="shadow-lg rounded-4 bg-white p-0"
                    style="border: none; box-shadow: 0 10px 32px 0 #1F21380A, 0 1.5px 6px 0 #C850C022;">
                    <table class="table align-middle mb-0 table-borderless">
                        <thead>
                            <tr style="border-bottom: 1.5px solid #f1e7f7;">
                                <th style="width: 5%;">ID</th>
                                <th style="width: 26%;">Usuario</th>
                                <th style="width: 20%;">Email</th>
                                <th style="width: 12%;">Rol</th>
                                <th style="width: 17%;">Sucursal</th>
                                <th style="width: 20%;" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="fw-bold text-secondary">{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->photo }}" alt="{{ $user->name }}"
                                            class="rounded-circle me-3 shadow-sm"
                                            style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #e9d8f5;">
                                        <a href="{{ route('users.show', $user->id) }}"
                                            class="fw-medium text-decoration-none"
                                            style="font-size: 1.07rem; background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; background-clip: text; color: transparent;">
                                            {{ $user->name }}
                                        </a>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $user->email }}</td>
                                <td>
                                    @switch($user->role)
                                    @case('admin')
                                    <span class="badge rounded-pill px-3 py-2"
                                        style="background: #dc3545; color: #fff; font-weight:600; font-size: .98rem;">
                                        Admin
                                    </span>
                                    @break
                                    @case('manager')
                                    <span class="badge rounded-pill px-3 py-2"
                                        style="background: #ffc107; color: #7A5100; font-weight:600; font-size: .98rem;">
                                        Gerente
                                    </span>
                                    @break
                                    @default
                                    <span class="badge rounded-pill px-3 py-2"
                                        style="background: #63686e; color: #fff; font-weight:600; font-size: .98rem;">
                                        Empleado
                                    </span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($user->branch)
                                    <span class="fw-medium user-gradient">{{ $user->branch->name }}</span>
                                    @else
                                    <span class="text-muted">No asignada</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('users.show', $user->id) }}"
                                        class="btn btn-link p-0 m-0 me-2"
                                        title="Ver"
                                        style="color:#C850C0;">
                                        <i class="bi bi-eye" style="font-size: 1.25rem; vertical-align: middle;"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-link p-0 m-0 me-2"
                                        title="Editar"
                                        style="color:#FFB300;">
                                        <i class="bi bi-pencil-square" style="font-size: 1.25rem; vertical-align: middle;"></i>
                                    </a>
                                    @if(auth()->id() != $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-link p-0 m-0"
                                            title="Eliminar"
                                            style="color:#c53db4;"
                                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="bi bi-trash" style="font-size: 1.25rem; vertical-align: middle;"></i>
                                        </button>
                                    </form>
                                    @else
                                    <button type="button"
                                        class="btn btn-link p-0 m-0"
                                        title="No puedes eliminar tu propio usuario"
                                        style="color:#bbb; cursor: not-allowed;">
                                        <i class="bi bi-trash" style="font-size: 1.25rem; vertical-align: middle;"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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