@section('js')
<script type="text/javascript">
    function readURL() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).prev().attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $(".uploads").change(readURL)
        $("#f").submit(function() {
            // do ajax submit or just classic form submit
            //  alert("fake subminting")
            return false
        })
    })


    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('submit').disabled = false;
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('submit').disabled = true;
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
        }
    }
</script>
@stop

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Pengguna <b>[{{$data->username}}]</b></h4>

                        <div class="form-group">
                                <div class="col-md-12" style="margin-left: -5px;">
                                    <img class="product" width="200" height="200" @if($data->karyawan->gambar) src="{{ asset('images/user/'.$data->karyawan->gambar) }}" @endif />
                                </div>
                        </div>

                        <div class="d-flex flex-row">
                            <p for="name" class="p-2">Nama Pengguna :</p>
                                <div class="p-2">
                                <p><b>{{ $data->karyawan->nama }}</b></p>
                                </div>
                        </div>

                        <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="email" class="p-2">E-Mail Address&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="p-2">
                                <p><b>{{ $data->email }}</b></p>
                                </div>
                        </div>

                        <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="username" class="p-2">Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="p-2" style="margin-top: -3px;">
                                <label class="badge badge-primary">{{ $data->username }}</label>
                                </div>
                        </div>

                        <div class="d-flex flex-row" style="margin-top: -20px; margin-left: -1px;">
                            <p for="level" class="p-2">Akses Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="p-2" style="margin-top: -3px;">
                                <label class="badge badge-danger">{{ $data->level }}</label>
                                </div>
                        </div>
                        <a href="{{route('user.index')}}" class="btn btn-light pull-left">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection