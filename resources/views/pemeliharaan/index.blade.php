@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "language": {
        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
        "sEmptyTable": "Tidak ada data di database"
      }
    });
  });

  // $(document).ready(function() {
  //   $('#table2').DataTable({
  //     "language": {
  //       "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
  //       "sEmptyTable": "Tidak ada data di database"
  //     }
  //   });
  // });

  // $(document).ready(function() {
  //   $('#table3').DataTable({
  //     "language": {
  //       "emptyTable": "Belum Ada Pengajuan Yang Harus Di Proses",
  //     }
  //   });
  // });
</script>
@stop

@extends('layouts.app')
@section('content')

<div class="row">
  @if(Auth::user()->level == 'it')
  <div class="col-lg-2">
    <a href="{{ route('pemeliharaan.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Ajukan Pemeliharaan</a>
  </div>
  @endif

  <div class="col-lg-12">
    @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
    @endif
  </div>
</div>

@if(Auth::user()->level == 'manager')
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Pengajuan Masuk Yang Harus Segera di Tindaklanjuti</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
                  Kode Pemeliharaan
                </th>
                <th>
                  Tanggal Pengajuan
                </th>
                <th>
                  Kode Aset
                </th>
                <th>
                  Nama Aset
                </th>
                <th>
                  Status
                </th>
                <th>
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($datapengajuan as $data)
              <tr>
                <td>
                  {{$data->kode_pemeliharaan}}
                </td>
                <td>
                  {{$data->created_at}}
                </td>
                <td>
                  {{$data->aset->kode_aset}}
                </td>
                <td>
                  {{$data->aset->nama_aset}}
                </td>
                <td>
                  @if($data->status == '1')
                  <label class="badge badge-warning">Menunggu Keputusan</label>
                  @endif
                </td>
                <td>
                  @if(Auth::user()->level == 'manager')
                  @if($data->status == '1')
                    <a class="badge badge-primary fa fa-eye" href="{{ route('pemeliharaan.show', $data->id) }}">&nbsp;&nbsp;Lihat Detail Pengajuan</a>
                  </form>
                  @endif
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{-- {!! $datas->links() !!} --}}
      </div>
    </div>
  </div>
</div>

<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Pengajuan Masuk</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
                  No
                </th>
                <th>
                  Kode Pemeliharaan
                </th>
                <th>
                  Tanggal Pengajuan
                </th>
                <th>
                  Kode Aset
                </th>
                <th>
                  Nama Aset
                </th>
                <th>
                  Status
                </th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($antriandatapengajuan as $data)
              <tr>
                <td>
                  {{ $no++ }}
                </td>
                <td>
                  {{$data->kode_pemeliharaan}}
                </td>
                <td>
                  {{$data->created_at}}
                </td>
                <td>
                  {{$data->aset->kode_aset}}
                </td>
                <td>
                  {{$data->aset->nama_aset}}
                </td>
                <td>
                  @if($data->status == '1')
                  <label class="badge badge-warning">Menunggu Keputusan</label>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{-- {!! $datas->links() !!} --}}
      </div>
    </div>
  </div>
</div>
@endif

<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Data Keseluruhan Pengajuan</h4>
        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Tanggal Pengajuan
                </th>
                <th>
                  Kode Aset
                </th>
                <th>
                  Nama Aset
                </th>
                <th>
                  Biaya
                </th>
                <th>
                  Status
                </th>
                <th>
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($datas as $data)
              <tr>
                <td>
                  {{date('d F Y h:i a', strtotime($data->created_at))}}
                </td>
                <td>
                  {{$data->aset->kode_aset}}
                </td>
                <td>
                  {{$data->aset->nama_aset}}
                </td>
                <td>
                  @currency($data->biaya)
                </td>
                <td>
                  @if($data->status == '1')
                  <label class="badge badge-warning">Menunggu Keputusan</label>
                  @elseif($data->status == '2')
                  <label class="badge badge-success">Pengajuan Disetujui</label>
                  @else
                  <label class="badge badge-danger">Pengajuan Ditolak</label>
                  @endif
                </td>
                <td>
                  @if($data->status == '2')
                    <a class="badge badge-success fa fa-print" href="{{ route('pemeliharaan.show', $data->id) }}">&nbsp;&nbsp;Print</a>
                  </form>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{-- {!! $datas->links() !!} --}}
      </div>
    </div>
  </div>
</div>
@endsection