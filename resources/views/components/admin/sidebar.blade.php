<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-text mx-3">NOMADS Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->

      <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.index') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      
      <!-- Nav Item - Paket Travel -->
      <li class="nav-item {{ request()->is('admin/travel-packages') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.travel-packages.index') }}">
          <i class="fas fa-fw fa-hotel"></i>
          <span>Travel Packages</span></a>
      </li>
      
      <!-- Nav Item - Galeri Travel -->
      <li class="nav-item {{ request()->is('admin/galleries') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.galleries.index') }}">
          <i class="fas fa-fw fa-images"></i>
          <span>Travel Galleries</span></a>
      </li>
      
      <!-- Nav Item - Transaksi -->
      <li class="nav-item {{ Request::is('admin/transactions*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.transactions.index') }}">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Transactions</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->