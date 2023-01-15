@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-account-card-details text-primary icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Karyawan</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$karyawan->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-account mr-1" aria-hidden="true"></i> Total seluruh karyawan
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-account-location text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pengguna Sistem</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$user->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-account mr-1" aria-hidden="true"></i> Total seluruh pengguna sistem
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-account-card-details text-warning icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Supir</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$driver->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-account mr-1" aria-hidden="true"></i> Total seluruh supir
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-content-paste text-success icon-lg" style="width: 40px;height: 40px;"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Kategori</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$kategori->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-content-paste mr-1" aria-hidden="true"></i> Total seluruh kategori
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-content-paste text-success icon-lg" style="width: 40px;height: 40px;"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Aset</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$aset->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-content-paste mr-1" aria-hidden="true"></i> Total seluruh aset
        </p>
      </div>
    </div>
  </div>

  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-content-paste text-success icon-lg" style="width: 40px;height: 40px;"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pemeliharaan</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">@currency($pemeliharaan->sum('biaya'))</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total biaya pemeliharaan yang sudah disetujui
        </p>
      </div>
    </div>
  </div>


  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-library-books text-warning icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">P. Aset IT</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$transaksi->where('status', 'pinjam')->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Aset yang sedang dipinjam
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-library-books text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pengembalian</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$transaksi->where('status', 'kembali')->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total seluruh pengembalian Aset IT
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-library-books text-warning icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">P. Aset Autocare</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$transaksiac->where('status', 'pinjam')->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Aset yang sedang dipinjam
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-library-books text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pengembalian</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$transaksiac->where('status', 'kembali')->count()}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Aset Autocare yang sudah dikembalikan
        </p>
      </div>
    </div>
  </div>
</div>
@endsection