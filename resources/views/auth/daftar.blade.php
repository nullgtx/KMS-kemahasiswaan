@extends('layouts.admin')

@section('content')

<div class="register-box">
  <div class="register-logo">
    <a href="#S"><b>KMS</b> Kemahasiswaan</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Mendaftar Menjadi Anggota Baru</p>

      <form method="POST" action="{{ route('register') }}">
            @csrf

        <div class="input-group mb-3">
          <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" placeholder="NIM" name="nim" value="{{ old('nim') }}" required autocomplete="nim" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
            @error('nim')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}" required autocomplete="new-password" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password-confirm" type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation" required autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="register" name="register" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{ route('login') }}" class="text-center">Sudah Punya Akun</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
@endsection

