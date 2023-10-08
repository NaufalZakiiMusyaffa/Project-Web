<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lupa Password | Management Aset</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/iconfonts/puse-icons-feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="{{asset('css/stylelogin.css')}}">
  <!-- endinject -->
  <link rel="icon" href="{{url('images/iconamanda.png')}}" />
</head>

<body>
  {{-- <div class="card"> --}}
    {{-- <div class="image">
      <img src="{{url('images/logoamanda.png')}}">
    </div> --}}
    <div class="content">
      <div class="details">
        <h3 style="text-align: center; margin-bottom: 25px;">RESET PASSWORD</h3>
        <form method="POST" action="{{ route('forgot-password.store') }}">
          {{ csrf_field() }}
          <div class="container">
            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
              {{-- <label class="label">Email</label> --}}
            </div>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukan Email Anda" required>
            @if ($errors->has('email'))
            <span class="help-block">
              <h6>{{ $errors->first('email') }}
                <h6>
            </span>
            @endif
            <br>
            <button class="btn btn-primary submit-btn btn-block" type="submit">Reset</button>
          </div>
        </form>
        <h6>Amanda Brownies © {{date('Y')}}. All rights reserved.</h6>
      </div>
    </div>
  {{-- </div> --}}
  <script src="{{asset('js/sweetalert2.all.js')}}"></script>
  
  @include('sweetalert::alert')
</body>

</html>