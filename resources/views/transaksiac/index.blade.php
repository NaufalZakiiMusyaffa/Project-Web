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
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-2">
    <a href="{{ route('transaksiac.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Peminjaman</a>
  </div>
  <div class="col-lg-12">
    @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
    @endif
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Data Keseluruhan Peminjaman / Pengembalian Aset Autocare</h4>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode Peminjaman
                </th>
                <th>
                  Nama Kendaraan
                </th>
                <th>
                  Peminjam
                </th>
                <th>
                  Supir
                </th>
                <th>
                  Tgl Pinjam
                </th>
                <th>
                  Tgl Kembali
                </th>
                <th>
                  Keterangan
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
                  {{$data->kode_peminjaman}}
                </td>
                <td>

                  {{$data->asetac->nama_kendaraan}}

                </td>

                <td>
                  {{$data->karyawan->nama}}
                </td>
                <td>
                  {{$data->supir->nama_supir}}
                </td>
                <td>
                  {{$data->tgl_pinjam}}
                </td>
                <td>
                  {{$data->tgl_kembali}}
                </td>
                <td>
                  {{$data->ket}}
                </td>
                <td>
                  @if($data->status == 'pinjam')
                  <label class="badge badge-warning">Sedang dipinjam</label>
                  @else
                  <label class="badge badge-success">Sudah Kembali</label>
                  @endif
                </td>
                <td>
                  @if(Auth::user()->level == 'hrd')
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      @if($data->status == 'pinjam')
                      <form action="{{ route('transaksiac.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <button class="dropdown-item" onclick="return confirm('Anda yakin aset ini sudah kembali?')"> Sudah Kembali
                        </button>
                      </form>
                      @endif
                      @if($data->status == 'kembali')
                      <form action="{{ route('transaksi.destroy', $data->id) }}" class="pull-left" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Hapus
                        </button>
                      </form>
                      @endif
                    </div>
                  </div>
                  @else
                  @if($data->status == 'pinjam')
                  <form action="{{ route('transaksi.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <button class="btn btn-info btn-xs" onclick="return confirm('Anda yakin aset ini sudah kembali?')">Sudah Kembali
                    </button>
                  </form>
                  @else
                  -
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
@endsection