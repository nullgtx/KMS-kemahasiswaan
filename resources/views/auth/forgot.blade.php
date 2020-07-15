@extends('layouts.admin')

@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>KMS</b> Kemahasiswaan</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Email untuk melakukan reset password</p>
    
      <form method="POST" action="{{ route('forgot') }}">
            @csrf
            @method('post')
      
            @if(session('fail'))
                    <div style="background: rgba(221, 28, 28, 0.664); padding: 10px; margin-bottom: 20px;" class="text-center w-full">
						<div class="txt1" style="color: white;">
							{{ session('fail') }}			
						</div>
					</div>
                    @endif

                    @error('email')
                    <div style="background: rgba(221, 28, 28, 0.664); padding: 10px; margin-bottom: 20px;" class="text-center w-full">
                        <div class="txt1" style="color: white;">
                            {{ $message }}			
                        </div>
                    </div>
                    @enderror

              <div class="input-group mb-3">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Reset</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="{{ route('login') }}">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection