<div class="sidebar">
    <!--- SidebarSearch Form-->
    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
          <a href="{{ url('/dashboard')}}" class="nav-link {{($activeMenu == 'dashboard')? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @if(auth()->user()->jenispengguna->jenis_kode == "ADM")
        <li class="nav-header">Data Pengguna</li>
          <li class="nav-item">
            <a href="{{ url('/jenis_pengguna')}}" class="nav-link {{($activeMenu == 'jenis_pengguna')? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-users-gear"></i>
              <p>Jenis Pengguna</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/pengguna')}}" class="nav-link {{($activeMenu == 'pengguna')? 'active' : ''}}">
              <i class="nav-icon far fa-address-book"></i>
              <p>Data Dosen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/poindosen')}}" class="nav-link {{($activeMenu == 'poindosen')? 'active' : ''}}">
                <i class="nav-icon fa-solid fa-coins"></i>
                <p>Poin Dosen</p>
            </a>
          </li>
          <li class="nav-header">Data Kegiatan</li>
          <li class="nav-item">
            <a href="{{ url('/kegiatan')}}" class="nav-link {{($activeMenu == 'kegiatan')? 'active' : ''}}">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>Kegiatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/statistik')}}" class="nav-link {{($activeMenu == 'statistik')? 'active' : ''}}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Statistik </p>
            </a>
          </li>
          @endif
        @if(auth()->user()->jenispengguna->jenis_kode == "PMN")
        <li class="nav-header">Data Kegiatan</li>
          <li class="nav-item">
            <a href="{{ url('/level')}}" class="nav-link {{($activeMenu == 'level')? 'active' : ''}}">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>Kegiatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/statistik')}}" class="nav-link {{($activeMenu == 'statistik')? 'active' : ''}}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Statistik </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/pengguna')}}" class="nav-link {{($activeMenu == 'pengguna')? 'active' : ''}}">
              <i class="nav-icon far fa-address-book"></i>
              <p>Data Dosen</p>
            </a>
          </li>
        @endif
        @if(auth()->user()->jenispengguna->jenis_kode == "DPC")
        <li class="nav-header">Data Kegiatan</li>
          <li class="nav-item">
            <a href="{{ url('/level')}}" class="nav-link {{($activeMenu == 'level')? 'active' : ''}}">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>Kegiatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/stok')}}" class="nav-link {{($activeMenu == 'stok')? 'active' : ''}}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Progress Kegiatan </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/stok')}}" class="nav-link {{($activeMenu == 'stok')? 'active' : ''}}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Agenda Kegiatan </p>
            </a>
          </li>
          <li class="nav-header">Manage Pengguna</li>
          <li class="nav-item">
            <a href="{{ url('/user')}}" class="nav-link {{($activeMenu == 'user')? 'active' : ''}}">
              <i class="nav-icon fas fa-user"></i>
              <p>Data Dosen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/stok')}}" class="nav-link {{($activeMenu == 'stok')? 'active' : ''}}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Statistik </p>
            </a>
          </li>
        @endif
        @if(auth()->user()->jenispengguna->jenis_kode == "DSA")
        <li class="nav-header">Data Kegiatan</li>
          <li class="nav-item">
            <a href="{{ url('/level')}}" class="nav-link {{($activeMenu == 'level')? 'active' : ''}}">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>Kegiatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/stok')}}" class="nav-link {{($activeMenu == 'stok')? 'active' : ''}}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Agenda Kegiatan </p>
            </a>
          </li>
          <li class="nav-header">Poin</li>
          <li class="nav-item">
            <a href="{{ url('/pengguna')}}" class="nav-link {{($activeMenu == 'pengguna')? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-coins"></i>
              <p>Poin Ku</p>
            </a>
          </li>
        @endif
      </ul>
    </nav>
  </div>