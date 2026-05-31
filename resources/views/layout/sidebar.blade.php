<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item sidebar-category">
      <p>Navigation</p>
      <span></span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="mdi mdi-view-quilt menu-icon"></i>
        <span class="menu-title">Dashboard</span>
        <div class="badge badge-info badge-pill">2</div>
      </a>
    </li>
    <li class="nav-item sidebar-category">
      <p>Data Master</p>
      <span></span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('mobil') }}">
        <i class="mdi mdi-car menu-icon"></i>
        <span class="menu-title">Data Mobil</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('pelanggan') }}">
        <i class="mdi mdi-account-group menu-icon"></i>
        <span class="menu-title">Data Pelanggan</span>
      </a>
    </li>
    @if (session('level_user') == 1)
      <li class="nav-item sidebar-category">
        <p>User</p>
        <span></span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('user') }}">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Manajamen User</span>
        </a>

    @endif

    </li>
  
  </ul>
</nav>