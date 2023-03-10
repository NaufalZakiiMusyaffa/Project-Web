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

  <div class="col-lg-8">
    <a href="{{ route('aset.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data Aset</a>
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
        <h4 class="card-title pull-left">Data Aset IT</h4>
        <!--      <a href="{{url('format_buku')}}" class="btn btn-xs btn-info pull-right">Format Buku</a> -->
        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode Aset
                </th>
                <th>
                  Nama Aset
                </th>
                <th>
                  Kategori
                </th>
                <th>
                  Merk
                </th>
                <th>
                  Spesifikasi
                </th>
                <th>
                  Tanggal Beli
                </th>
                <th>
                  Garansi
                </th>
                <th>
                  Harga Beli
                </th>
                <th>
                  Vendor
                </th>
                <th>
                  Alamat Vendor
                </th>
                <th>
                  Status Aset
                </th>
                <th>
                  Inventaris Kepada
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
                  {{$data->kode_aset}}
                </td>
                <td>
                  <a href="{{route('aset.show', $data->id)}}">
                    {{$data->nama_aset}}
                  </a>
                </td>
                <td>
                  {{$data->kategori->nama_kategori}}
                </td>
                <td>
                  {{$data->merk}}
                </td>
                <td>
                  {{$data->spesifikasi}}
                </td>
                <td>
                  {{$data->tgl_beli}}
                </td>
                <td>
                  {{$data->garansi}}
                </td>
                <td>
                  @currency($data->harga_beli)
                </td>
                <td>
                  {{$data->toko_beli}}
                </td>
                <td>
                  {{$data->alamat}}
                </td>
                <td>
                  @if($data->jumlah_aset == '0')
                  <label class="badge badge-primary">Sedang dipinjam</label>
                  @elseif($data->jumlah_aset == '1')
                  <label class="badge badge-success">Siap digunakan</label>
                  @elseif($data->jumlah_aset == '2')
                  <label class="badge badge-warning">Digunakan</label>
                  @elseif($data->jumlah_aset == '3')
                  <label class="badge badge-danger">Rusak(Bisa diperbaiki)</label>
                  @elseif($data->jumlah_aset == '4')
                  <label class="badge badge-info">Sedang diperbaiki</label>
                  @else
                  <label class="badge badge-danger">Rusak Total</label>
                  @endif
                </td>
                <td>
                  @if($data->karyawan != null)
                  <label class="badge badge-primary">{{$data->karyawan->nama}}</label>
                  @else
                  <label class="badge badge-primary">-</label>
                  @endif
                </td>
                <td>
                  @if($data->jumlah_aset > '0')
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      <a class="dropdown-item" href="{{route('aset.edit', $data->id)}}"> Ubah Data </a>
                      <form action="{{ route('aset.destroy', $data->id) }}" class="pull-left" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Hapus Data
                        </button>
                      </form>
                    </div>
                  </div>
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