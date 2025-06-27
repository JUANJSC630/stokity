<aside class="app-sidebar d-flex flex-column align-items-center p-0" style="min-height: 100vh; width: 250px; background: #fff;">
  <!-- Brand -->
  <div class="w-100 text-center py-4">
    <a href="/" class="text-decoration-none d-flex flex-column align-items-center">
      <img
        src="https://img.icons8.com/color/96/000000/rocket--v1.png"
        alt="Logo"
        class="mb-2 rounded-circle shadow"
        style="width: 66px; height: 66px; background: #fff; border: 3px solid #f7e1ff; object-fit: cover;" />
      <span class="fw-bold fs-4 mb-0"
        style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">Stokity</span>
    </a>
  </div>
  <!-- Menu -->
  <nav class="flex-grow-1 w-100 px-3">
    <ul class="nav flex-column gap-1">
      <li class="nav-item">
        <a href="{{ url('/') }}"
          class="nav-link sidebar-link d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-semibold
           @if(request()->is('/')) active-gradient @endif">
          <i class="bi bi-speedometer2"></i>
          <span>Inicio</span>
        </a>
      </li>
      @if(auth()->user() && auth()->user()->role !== 'employee')
      <li class="nav-item">
        <a href="{{ url('users') }}"
          class="nav-link sidebar-link d-flex align-items-center gap-2 px-3 py-2 rounded-3
           @if(request()->is('users*')) active-gradient @endif">
          <i class="bi bi-person"></i>
          <span>Usuarios</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('branches') }}"
          class="nav-link sidebar-link d-flex align-items-centert gap-2 px-3 py-2 rounded-3
           @if(request()->is('branches*')) active-gradient @endif">
          <i class="bi bi-building"></i>
          <span>Sucursales</span>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a href="{{ url('categories') }}"
          class="nav-link sidebar-link d-flex align-items-center gap-2 px-3 py-2 rounded-3
           @if(request()->is('categories*')) active-gradient @endif">
          <i class="bi bi-tags"></i>
          <span>Categorías</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('products') }}"
          class="nav-link sidebar-link d-flex align-items-center gap-2 px-3 py-2 rounded-3
           @if(request()->is('products*')) active-gradient @endif">
          <i class="bi bi-box"></i>
          <span>Productos</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('clients') }}"
          class="nav-link sidebar-link d-flex align-items-center gap-2 px-3 py-2 rounded-3
           @if(request()->is('clients*')) active-gradient @endif">
          <i class="bi bi-people"></i>
          <span>Clientes</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('sales') }}"
          class="nav-link sidebar-link d-flex align-items-center gap-2 px-3 py-2 rounded-3
           @if(request()->is('sales*')) active-gradient @endif">
          <i class="bi bi-cash-coin"></i>
          <span>Administrar Ventas</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('report-sales') }}"
          class="nav-link sidebar-link d-flex align-items-center gap-2 px-3 py-2 rounded-3
           @if(request()->is('report-sales*')) active-gradient @endif">
          <i class="bi bi-bar-chart"></i>
          <span>Reportes de Ventas</span>
        </a>
      </li>
    </ul>
  </nav>
  <div class="text-center py-4 mt-auto small text-muted w-100" style="letter-spacing: .01em;">
    © {{ date('Y') }} Stokity. MegaWow.
  </div>
</aside>

<style>
  .sidebar-link {
    color: #fff !important;
    background: none;
    transition: background .18s, color .18s, box-shadow .18s;
    font-size: 1.08rem;
    text-decoration: none !important;
  }

  .sidebar-link i {
    color: #C850C0;
    font-size: 1.22rem;
    transition: color .18s;
  }

  .app-sidebar a.nav-link {
    color: #212529 !important;
    text-decoration: none !important;
  }

  .sidebar-link:hover,
  .sidebar-link:focus {
    background: #f7e1ff44;
    color: #C850C0;
  }

  .sidebar-link:hover i,
  .sidebar-link:focus i {
    color: #C850C0;
  }

  .active-gradient {
    background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%) !important;
    color: #fff !important;
    font-weight: 600;
    box-shadow: 0 2px 10px 0 #ffcc7040;
  }

  .active-gradient i {
    color: #fff !important;
  }
</style>