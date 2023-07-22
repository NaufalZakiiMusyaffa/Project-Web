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
      <img src="{{url('images/laporan/logo.png')}}" style="margin: auto; width:200px;" />
    </div>
  </a>
  
  <div class="garis-pembatas"></div>
  <span class="menu-title ml-5 my-2" style="color: #4a4a4a;">Profile | {{ Auth::user()->level }}</span>
    <li class="nav-item">
    <a class="nav-link drop-menu" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
      @if(Auth::user()->karyawan->gambar == '')
      <img class="img-xs rounded-circle" src="{{asset('images/user/default.png')}}" alt="profile image" style="width:40px;height:30px;">
      @else
      <img class="img-xs rounded-circle" src="{{asset('images/user/'.Auth::user()->karyawan->gambar)}}" alt="profile image" style="width:40px;height:30px;">
      @endif
      <span class="profile-text ml-2">{{Auth::user()->karyawan->nama}}  <span class="status-indicator online"></span></span>        
    </a>
    <div class="collapse" id="ui-basic1">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link drop-menu-item" style="margin-top: 20px;" href="{{route('user.edit', Auth::user()->id)}}">
            Ubah Profil
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link drop-menu-item" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
               Keluar
   
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 {{ csrf_field() }}
               </form>
             </a>
        </li>
      </ul>
    </div>
  </li>
  <div class="garis-pembatas"></div>
  <span class="menu-title ml-5 my-2" style="color: #4a4a4a;">Home</span>
  <li class="nav-item {{ setActive(['/', 'home']) }}">
    <a class="nav-link" href="{{url('/')}}">
      <i class="menu-icon mdi mdi-view-dashboard"></i>
      <span class="menu-title">Beranda</span>
    </a>
  </li>
  @if(Auth::user()->level == 'manager')
  <li class="nav-item {{ setActive(['user*']) }}">
    <a class="nav-link" href="{{route('user.index')}}">
      <i class="menu-icon mdi mdi-account-multiple"></i>
      <span class="menu-title">Data Pengguna</span>
    </a>
  </li>
  <li class="nav-item {{ setActive(['karyawan*']) }}">
    <a class="nav-link" href="{{route('karyawan.index')}}">
      <i class="menu-icon mdi mdi-folder-account"></i>
      <span class="menu-title">Data Karyawan</span>
    </a>
  </li>
  @endif

  @if(Auth::user()->level == 'manager' || Auth::user()->level == 'it')
  <li class="nav-item {{ setActive(['kategori*', 'aset*', 'history*', 'pemeliharaan*']) }}">
    <a class="nav-link drop-menu" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-database"></i>
      <span class="menu-title">Data IT</span>
      <i class="menu-arrow"></i>
    </a>

    <div class="collapse {{ setShow(['kategori*', 'aset*', 'history*', 'pemeliharaan*']) }}" id="ui-basic2">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link {{ setActive(['kategori*']) }} drop-menu-item" href="{{route('kategori.index')}}">Data Kategori IT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['aset*']) }} drop-menu-item" href="{{route('aset.index')}}">Data Aset IT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['history*']) }} drop-menu-item" href="{{route('history.index')}}">Jejak Aset IT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['pemeliharaan*']) }} drop-menu-item" href="{{route('pemeliharaan.index')}}">Pengajuan Perbaikan</a>
        </li>
      </ul>
    </div>
  </li>
  @endif

  @if(Auth::user()->level == 'manager' || Auth::user()->level == 'autocare')
  <li class="nav-item {{ setActive(['driver*', 'asetac*']) }}">
    <a class="nav-link drop-menu" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-database"></i>
      <span class="menu-title">Data Autocare</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{ setShow(['driver*', 'asetac*']) }}" id="ui-basic3">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link {{ setActive(['driver*']) }} drop-menu-item" href="{{route('driver.index')}}">Data Supir</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['asetac*']) }} drop-menu-item" href="{{route('asetac.index')}}">Data Aset Autocare</a>
        </li>
      </ul>
    </div>
  </li>
  @endif

  <li class="nav-item {{ setActive(['transaksi*', 'autocare-transaksi*']) }}">
    <a class="nav-link drop-menu" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-content-copy"></i>
      <span class="menu-title">Peminjaman</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{ setShow(['transaksi*', 'autocare-transaksi*']) }}" id="ui-basic4">
      <ul class="nav flex-column sub-menu">
        @if(Auth::user()->level == 'manager' || Auth::user()->level == 'it')
        <li class="nav-item">
          <a class="nav-link {{ setActive(['transaksi*']) }} drop-menu-item" href="{{route('transaksi.index')}}">Peminjaman Aset IT</a>
        </li>
        @endif
        @if(Auth::user()->level == 'manager' || Auth::user()->level == 'autocare')
        <li class="nav-item">
          <a class="nav-link {{ setActive(['autocare-transaksi*']) }} drop-menu-item" href="{{route('autocare-transaksi.index')}}">Peminjaman Aset Autocare</a>
        </li>
        @endif
      </ul>
    </div>
  </li>

  {{-- @if(Auth::user()->level == 'manager')
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
  @endif --}}


</ul>