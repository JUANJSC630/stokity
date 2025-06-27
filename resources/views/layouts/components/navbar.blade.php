<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-white shadow-sm" style="background: #fff !important; border-bottom: 0;">
  <div class="container-fluid d-flex justify-content-between align-items-center py-2">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list fs-4" style="color: #C850C0;"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center"
          data-bs-toggle="dropdown" data-bs-auto-close="outside">
          <img
            src="{{ Auth::user()->photo }}"
            class="user-image rounded-circle shadow"
            style="width: 36px; height: 36px; object-fit: cover; border: 2.5px solid #f7e1ff;"
            alt="User Image" />
          <span class="d-none d-md-inline ms-2 fw-semibold user-gradient"
            style="font-size: 1.03rem;">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow rounded-4"
          style="max-width: 320px; z-index: 1050; left: auto; right: 0; border: none;">
          <!--begin::User Image-->
          <li class="user-header text-center py-4 rounded-top"
            style="background: linear-gradient(90deg, #C850C0, #FFCC70); color: #fff;">
            <img
              src="{{ Auth::user()->photo }}"
              class="rounded-circle shadow"
              alt="User Image"
              style="width: 90px; height: 90px; object-fit: cover; border: 4px solid #fff;" />
            <p class="mt-3 mb-0 fw-bold" style="font-size: 1.09rem;">{{ Auth::user()->name }}</p>
            @switch(Auth::user()->role)
              @case('admin')
                <span class="badge rounded-pill px-3 py-2 mt-2 mb-1"
                  style="background: #fff; color: #C850C0; font-weight:600; font-size: .98rem;">
                  Administrador
                </span>
              @break
              @case('manager')
                <span class="badge rounded-pill px-3 py-2 mt-2 mb-1"
                  style="background: #fff; color: #C850C0; font-weight:600; font-size: .98rem;">
                  Encargado
                </span>
              @break
              @default
                <span class="badge rounded-pill px-3 py-2 mt-2 mb-1"
                  style="background: #fff; color: #C850C0; font-weight:600; font-size: .98rem;">
                  Vendedor
                </span>
            @endswitch
            <div class="small mt-2" style="color: #fff9; font-weight: 400;">
              Miembro desde {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d M Y') }}
            </div>
          </li>
          <!--end::User Image-->
          <!--begin::Menu Footer-->
          <li class="user-footer p-3 border-top-0 rounded-bottom"
            style="background: #faf8fd;">
            <div class="row g-2">
              <div class="col-6">
                <a href="{{ route('users.show', Auth::id()) }}"
                  class="btn btn-sm btn-light w-100 fw-medium border-0"
                  style="border-radius: 0.7rem; color: #C850C0;">
                  <i class="bi bi-person me-1"></i>Mi Perfil
                </a>
              </div>
              <div class="col-6">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                  @csrf
                  <button type="submit"
                    class="btn btn-sm btn-light w-100 fw-medium border-0"
                    style="border-radius: 0.7rem; color: #dc3545;">
                    <i class="bi bi-box-arrow-right me-1"></i>Cerrar sesión
                  </button>
                </form>
              </div>
            </div>
          </li>
          <!--end::Menu Footer-->
        </ul>
      </li>
    </ul>
  </div>
</nav>

@push('styles')
<style>
  .user-gradient {
    background: linear-gradient(90deg, #C850C0, #FFCC70);
    -webkit-background-clip: text;
    color: transparent;
  }

  .text-gradient {
    background: linear-gradient(90deg, #C850C0, #FFCC70);
    -webkit-background-clip: text;
    color: transparent !important;
  }

  .dropdown-menu-lg {
    border-radius: 1.3rem !important;
    overflow: hidden;
    border: none;
  }

  .user-header {
    border-top-left-radius: 1.3rem;
    border-top-right-radius: 1.3rem;
  }

  .user-footer {
    border-bottom-left-radius: 1.3rem;
    border-bottom-right-radius: 1.3rem;
  }

  .btn-light:focus,
  .btn-light:active {
    outline: none !important;
    box-shadow: 0 0 0 0.13rem #C850C033 !important;
  }
</style>
@endpush