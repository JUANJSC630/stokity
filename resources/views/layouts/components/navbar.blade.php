<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body shadow-sm">
  <div class="container-fluid d-flex justify-content-between">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list fs-5"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">
          <img
            src="{{ Auth::user()->photo }}"
            class="user-image rounded-circle shadow"
            style="width: 32px; height: 32px; object-fit: cover;"
            alt="User Image" />
          <span class="d-none d-md-inline ms-1">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow" style="max-width: 300px; z-index: 1050; left: auto; right: 0;">
          <!--begin::User Image-->
          <li class="user-header text-bg-primary py-4 rounded-top">
            <img
              src="{{ Auth::user()->photo }}"
              class="rounded-circle shadow"
              alt="User Image"
              style="width: 90px; height: 90px; object-fit: cover; border: 3px solid rgba(255,255,255,0.2);" />
            <p class="mt-2">
              {{ Auth::user()->name }}
              <small class="mt-1">{{ Auth::user()->role }}</small>
              <small>Miembro desde {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('D. M. Y') }}</small>
            </p>
          </li>
          <!--end::User Image-->
          <!--begin::Menu Body-->
          <li class="user-body p-2">
            <!--begin::Row-->
            <div class="row g-0">
              <div class="col-4 text-center"><a href="#" class="btn btn-link text-decoration-none">Perfil</a></div>
              <div class="col-4 text-center"><a href="#" class="btn btn-link text-decoration-none">Ajustes</a></div>
              <div class="col-4 text-center"><a href="#" class="btn btn-link text-decoration-none">Ayuda</a></div>
            </div>
            <!--end::Row-->
          </li>
          <!--end::Menu Body-->
          <!--begin::Menu Footer-->
          <li class="user-footer d-flex justify-content-between p-3 border-top">
            <a href="#" class="btn btn-outline-primary btn-sm">Mi Perfil</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-outline-danger btn-sm">Cerrar sesión</button>
            </form>
          </li>
          <!--end::Menu Footer-->
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
        </a>
      </li>
    </ul>
  </div>
</nav>