 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../../images/logo_krasem.png" alt="Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight">SIPENATA</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block" href="/profile/profile">{{ $dataUser->nama }}</a>
        </div>
      </div>

      {{-- <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @if (in_array(auth()->guard('admin')->user()->kategori, ['super admin']))
          <li class="nav-header">Master Data</li>
            <li class="nav-item">
              <a href="/dasarhukum/data" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Dasar Hukum</p>
              </a>
            </li>

          <li class="nav-header">Akun</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Data User
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/superadmin/data" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Super Admin</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/timadministratif/data" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Tim Administratif</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/timlapangan/data" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Tim Lapangan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/pemilikmenara/data" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Pemilik Menara</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/provider/data" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Provider</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif
          
          @if (in_array(auth()->guard('admin')->user()->kategori, ['tim administratif', 'tim lapangan', 'bupati', 'pemilik menara', 'provider']))
          <li class="nav-header">MANAJEMEN MENARA</li>
          @endif
            @if (in_array(auth()->guard('admin')->user()->kategori, ['tim administratif', 'pemilik menara']))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Data Menara
                </p>
              </a>
            </li>
            @endif
            @if (in_array(auth()->guard('admin')->user()->kategori, ['pemilik menara']))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Lokasi Menara
                </p>
              </a>
            </li>
            @endif
            @if (in_array(auth()->guard('admin')->user()->kategori, ['tim administratif', 'tim lapangan', 'bupati', 'pemilik menara']))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Pengajuan Menaraa
                </p>
              </a>
            </li>
            @endif
            @if (in_array(auth()->guard('admin')->user()->kategori, ['tim administratif', 'tim lapangan', 'bupati', 'pemilik menara']))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Pengajuan Perubahan Menara
                </p>
              </a>
            </li>
            @endif

          @if (in_array(auth()->guard('admin')->user()->kategori, ['super admin', 'tim administratif', 'pemilik menara']))
          <li class="nav-header">PELAPORAN</li>
          @endif
            @if (in_array(auth()->guard('admin')->user()->kategori, ['tim administratif', 'pemilik menara']))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Laporan Kondisi Menara
                </p>
              </a>
            </li>
            @endif
            @if (in_array(auth()->guard('admin')->user()->kategori, ['super admin']))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Laporan Data Menara
                </p>
              </a>
            </li>
            @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>