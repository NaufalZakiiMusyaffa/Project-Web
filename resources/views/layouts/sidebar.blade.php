<style>
  .garis-pembatas {
    margin-top: 5px;
    border-top: 1px solid #afbcc6;
    border-bottom: 1px solid #eff2f6;
    height: 0px;
  }
</style>

<ul class="nav">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center">
    <div class="sidebar-brand-icon rotate-n-0">
      <img src="{{url('images/logoamanda.png')}}" style="margin: auto; margin-bottom: -5px; width:100px;height:100px;" />
    </div>
  </a>

  <!-- Sidebar - Brand -->
  <br>
  <a class="sidebar-brand d-flex align-items-center justify-content-center">
    <h6>
      <div class="sidebar-brand-text mx-1">Management Aset</div>
    </h6>
  </a>

  <div class="garis-pembatas"></div>

  <li class="nav-item {{ setActive(['/', 'home']) }}">
    <a class="nav-link" href="{{url('/')}}">
      <i class="menu-icon mdi mdi-television"></i>
      <span class="menu-title">Beranda</span>
    </a>
  </li>
  @if(Auth::user()->level == 'hrd')
  <li class="nav-item {{ setActive(['user*']) }}">
    <a class="nav-link" href="{{route('user.index')}}">
      <i class="menu-icon mdi mdi-backup-restore"></i>
      <span class="menu-title">Data Pengguna</span>
    </a>
  </li>
  <li class="nav-item {{ setActive(['karyawan*']) }}">
    <a class="nav-link" href="{{route('karyawan.index')}}">
      <i class="menu-icon mdi mdi-backup-restore"></i>
      <span class="menu-title">Data Karyawan</span>
    </a>
  </li>
  @endif


  <li class="nav-item {{ setActive(['kategori*', 'aset*', 'history*', 'pemeliharaan*']) }}">
    <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-content-copy"></i>
      <span class="menu-title">Data IT</span>
      <i class="menu-arrow"></i>
    </a>

    <div class="collapse {{ setShow(['kategori*', 'aset*', 'history*', 'pemeliharaan*']) }}" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link {{ setActive(['kategori*']) }}" href="{{route('kategori.index')}}">Data Kategori IT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['aset*']) }}" href="{{route('aset.index')}}">Data Aset IT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['history*']) }}" href="{{route('history.index')}}">Jejak Aset IT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['pemeliharaan*']) }}" href="{{route('pemeliharaan.index')}}">Pengajuan Perbaikan</a>
        </li>
      </ul>
    </div>
  </li>

  @if(Auth::user()->level == 'hrd')
  <li class="nav-item {{ setActive(['driver*', 'asetac*']) }}">
    <a class="nav-link " data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-content-copy"></i>
      <span class="menu-title">Data Autocare</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{ setShow(['driver*', 'asetac*']) }}" id="ui-basic3">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link {{ setActive(['driver*']) }}" href="{{route('driver.index')}}">Data Supir</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['asetac*']) }}" href="{{route('asetac.index')}}">Data Aset Autocare</a>
        </li>
      </ul>
    </div>
  </li>
  @endif

  <li class="nav-item {{ setActive(['transaksi*', 'transaksiac*']) }}">
    <a class="nav-link " data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-content-copy"></i>
      <span class="menu-title">Peminjaman</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{ setShow(['transaksi*', 'transaksiac*']) }}" id="ui-basic4">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link {{ setActive(['transaksi*']) }}" href="{{route('transaksi.index')}}">Peminjaman Aset IT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['transaksiac*']) }}" href="{{route('transaksiac.index')}}">Peminjaman Aset Autocare</a>
        </li>
      </ul>
    </div>
  </li>

  @if(Auth::user()->level == 'hrd')
  <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-laporan" aria-expanded="false" aria-controls="ui-laporan">
      <i class="menu-icon mdi mdi-table"></i>
      <span class="menu-title">Laporan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-laporan">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link" href="{{url('laporan/trs')}}">Laporan Transaksi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('laporan/aset')}}">Laporan Aset</a>
        </li>
      </ul>
    </div>
  </li>
  @endif


</ul>