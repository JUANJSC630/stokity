<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="/" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow" />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">Stokity</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>

  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="menu"
        data-accordion="false">
        <li class="nav-item menu-open">
          <a href="/" class="nav-link active">
            <i class="nav-icon bi bi-speedometer"></i>
            <span>
              Inicio
            </span>
          </a>
        </li>
        <hr class="border border-light" />
        <li class="nav-item menu-open">
          <a href="{{ url('users')  }}" class="nav-link active">
            <i class="nav-icon bi bi-person"></i>
            <span>
              Usuarios
            </span>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{ url('branches')  }}" class="nav-link active">
            <i class="nav-icon bi bi-building"></i>
            <span>
              Sucursales
            </span>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{ url('categories')  }}" class="nav-link active">
            <i class="nav-icon bi bi-tags"></i>
            <span>
              Categorías
            </span>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{ url('products')  }}" class="nav-link active">
            <i class="nav-icon bi bi-box"></i>
            <span>
              Productos
            </span>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{ url('clients')  }}" class="nav-link active">
            <i class="nav-icon bi bi-people"></i>
            <span>
              Clientes
            </span>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{ url('sales')  }}" class="nav-link active">
            <i class="nav-icon bi bi-cash-coin"></i>
            <span>
              Administrar Ventas
            </span>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{ url('report-sales')  }}" class="nav-link active">
            <i class="nav-icon bi bi-bar-chart"></i>
            <span>
              Reportes de Ventas
            </span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>