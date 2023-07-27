@section('js')
<script type="text/javascript">

  const userLevel = "{{Auth::user()->level }}";
  const tahun = new Date().getFullYear();

  // console.log("tes",userLevel)

  if (userLevel == 'manager' || userLevel == 'it') {
    var labels =  {!! json_encode($labels->toArray()) !!};
    var datas =  {!! json_encode($datas_graphics->toArray()) !!};

    const data = {
      labels: labels,
      datasets: [{
        label: 'Grafik Tabel Pemeliharaan Tahun '+tahun,
        backgroundColor: 'rgba(67,94,190,255)',
        borderColor: 'rgba(158,172,221,255)',
        data: datas,
      }]
    };

    const config = {
      type: 'bar',
      data: data,
      options: {}
    };

    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  }
  
  if (userLevel == 'manager' || userLevel == 'it') {
    var label_transaksi =  {!! json_encode($label_transaksi->toArray()) !!};
    var dataTransaksis =  {!! json_encode($transaksi_graphics->toArray()) !!};

    const dataTransaksi = {
      labels: label_transaksi,
      datasets: [{
        label: 'Grafik Transaksi Peminjaman Aset IT Tahun '+tahun,
        backgroundColor: 'rgba(67,94,190,255)',
        borderColor: 'rgba(158,172,221,255)',
        data: dataTransaksis,
      }]
    };

    const configTransaksi = {
      type: 'line',
      data: dataTransaksi,
      options: {}
    };

    const transaksiChart = new Chart(
      document.getElementById('transaksiChart'),
      configTransaksi
    );
  }
  
  if (userLevel == 'manager' || userLevel == 'autocare') {
    var label_transaksiac =  {!! json_encode($label_transaksiac->toArray()) !!};
    var dataTransaksiacs =  {!! json_encode($transaksiac_graphics->toArray()) !!};

    const dataTransaksiac = {
      labels: label_transaksiac,
      datasets: [{
        label: 'Grafik Transaksi Peminjaman Aset Autocare Tahun '+tahun,
        backgroundColor: 'rgba(67,94,190,255)',
        borderColor: 'rgba(158,172,221,255)',
        data: dataTransaksiacs,
      }]
    };

    const configTransaksiac = {
      type: 'line',
      data: dataTransaksiac,
      options: {}
    };

    const transaksiacChart = new Chart(
      document.getElementById('transaksiacChart'),
      configTransaksiac
    );
  }

  const karyawans = {!! json_encode($karyawan_pie) !!}
  const asets = {!! json_encode($aset_pie) !!}
  const asetacs = {!! json_encode($asetac_pie) !!}

  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    if (userLevel == 'manager') {
      var data = google.visualization.arrayToDataTable(karyawans);
      var options = {
        // title: 'Detail Karyawan',
        is3D: false,
        pieHole: 0.3,
      };
      var chart = new google.visualization.PieChart(document.getElementById('piechart_karyawan'));
      chart.draw(data, options);
    }
    
    if (userLevel == 'manager' || userLevel == 'it' || userLevel == 'karyawan') {
      var dataAset = google.visualization.arrayToDataTable(asets);
      var optionsAset = {
        is3D: false,
        pieHole: 0.3,
        pieSliceText: 'value'
      };
      var chartAset = new google.visualization.PieChart(document.getElementById('piechart_aset'));
      chartAset.draw(dataAset, optionsAset);
    }
    
    if (userLevel == 'manager' || userLevel == 'autocare' || userLevel == 'karyawan') {
      var dataAsetac = google.visualization.arrayToDataTable(asetacs);
      var optionsAsetac = {
        is3D: false,
        pieHole: 0.3,
        pieSliceText: 'value'
      };
      var chartAsetac = new google.visualization.PieChart(document.getElementById('piechart_asetac'));
      chartAsetac.draw(dataAsetac, optionsAsetac);
    }
  }  
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row justify-content-between">
  <div class="m-3 col-md-4">Manajemen Aset</div>
  @if(Auth::user()->level == 'manager')
  <div class="m-3 col-md-4">
    <a href="{{route('pemeliharaan.index')}}" class="ml-md-3"><i class="fa fa-bell"> Pengajuan Masuk</i>
      <span class="badge badge-danger">{{$notif_pemeliharaan}}</span>
    </a>
  </div>
  @endif
</div>
<div class="row">
  @if(Auth::user()->level == 'manager')
  <div class="col-xl-2 col-lg-2 col-md-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="row justify-content-between">
          <div class="col-3 mt-2">
            <i class="mdi mdi-radiobox-marked text-white icon-md bg-info p-0"></i>
          </div>
          <div class="col-9">
            <p class="mb-0 mt-1 text-right text-muted">Pengguna Sistem</p>
              <h4 class="font-weight-medium text-right mb-0">{{$user->count()}}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-2 col-lg-2 col-md-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="row justify-content-between">
          <div class="col-3 mt-2">
            <i class="mdi mdi-account-location text-white icon-md bg-primary p-0"></i>
          </div>
          <div class="col-9">
            <p class="mb-0 mt-1 text-right text-muted">Karyawan</p>
              <h4 class="font-weight-medium text-right mb-0">{{$karyawan->count()}}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-2 col-lg-2 col-md-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="row justify-content-between">
          <div class="col-3 mt-2">
            <i class="mdi mdi-car text-white icon-md bg-success p-0"></i>
          </div>
          <div class="col-9">
            <p class="mb-0 mt-1 text-right text-muted">Supir</p>
              <h4 class="font-weight-medium text-right mb-0">{{$driver->count()}}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-2 col-lg-2 col-md-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="row justify-content-between">
          <div class="col-3 mt-2">
            <i class="mdi mdi-archive text-white icon-md bg-danger p-0"></i>
          </div>
          <div class="col-9">
            <p class="mb-0 mt-1 text-right text-muted">Pengajuan Masuk</p>
              <h4 class="font-weight-medium text-right mb-0">{{$total_pemeliharaan}}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-8 col-sm-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix mt-2">
          <div class="float-left">
            @if(Auth::user()->karyawan->gambar == '')
            <img class="img-xs rounded-circle" src="{{asset('images/user/default.png')}}" alt="profile image" width="30"">
            @else
            <img class="img-xs rounded-circle" src="{{asset('images/user/'.Auth::user()->karyawan->gambar)}}" alt="profile image" width="30">
            @endif
          </div>
          <div class="float-left">
            <h4 class="mb-0 ml-2 text-left">{{Auth::user()->karyawan->nama}}</h4>
              <p class="font-weight-medium text-left mb-0 ml-2">Akses Login : {{ Auth::user()->level }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
{{-- </div> --}}
{{-- <div class="row"> --}}
  @if(Auth::user()->level == 'manager' || Auth::user()->level == 'it')
  <div class="col-xl-8 col-lg-8 col-md-8 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <canvas id="myChart" height="100px"></canvas>
      </div>
    </div>
  </div>
  @endif
  @if(Auth::user()->level == 'manager' || Auth::user()->level == 'it')
  <div class="col-xl-4 col-lg-4 col-md-8 col-sm-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="row h-100">
          <div class="col my-auto">
            <div class="text-center">
              <h5>Total Biaya Pemeliharaan</h5>
              <h3>@currency($pemeliharaan->sum('biaya'))</h3>
            </div>
          </div>
       </div>
      </div>
    </div>
  </div>
  @endif
{{-- </div> --}}
{{-- <div class="row"> --}}
  
  @if(Auth::user()->level == 'manager' || Auth::user()->level == 'it' || Auth::user()->level == 'karyawan')
  <div class="{{ Auth::user()->level == 'karyawan' ? 'col-xl-6 col-lg-6 col-md-6' : 'col-xl-4 col-lg-4 col-md-4' }} col-md-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <h5 class="text-left">Aset IT</h5>
        <div id="piechart_aset"></div>
      </div>
    </div>
  </div>
  @endif
  
  @if(Auth::user()->level == 'manager' || Auth::user()->level == 'autocare' || Auth::user()->level == 'karyawan')
  <div class="{{ Auth::user()->level == 'karyawan' ? 'col-xl-6 col-lg-6 col-md-6' : 'col-xl-4 col-lg-4 col-md-4' }} grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <h5 class="text-left">Aset Autocare</h5>
        <div id="piechart_asetac"></div>
      </div>
    </div>
  </div>
  @endif
  
  @if(Auth::user()->level == 'manager')
  <div class="col-xl-4 col-lg-4 col-md-4 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <h5 class="text-left">Detail Karyawan</h5>
        <div id="piechart_karyawan"></div>
      </div>
    </div>
  </div>
  @endif
{{-- </div> --}}
{{-- <div class="row"> --}}
  @if(Auth::user()->level == 'manager' || Auth::user()->level == 'it')
  <div class="{{ Auth::user()->level == 'it' ? 'col-xl-8 col-lg-8 col-md-8' : 'col-xl-6 col-lg-6 col-md-6' }} grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <canvas id="transaksiChart" height="100px"></canvas>
      </div>
    </div>
  </div>
  @endif
  
  @if(Auth::user()->level == 'manager' || Auth::user()->level == 'autocare')
  <div class="{{ Auth::user()->level == 'autocare' ? 'col-xl-8 col-lg-8 col-md-8' : 'col-xl-6 col-lg-6 col-md-6' }} grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <canvas id="transaksiacChart" height="100px"></canvas>
      </div>
    </div>
  </div>
  @endif
</div>


@endsection