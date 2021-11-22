@extends('layout.master-mini')
@section('content')



<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">

        @if (session('failed'))
        <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert"></button>
            {{ session('failed') }}
        </div>
        @endif

        <form id="logout-form" action="{{ route('checklogin') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="label">Usuário</label>
            <div class="input-group">
              <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
              id="email" name="email" required="required" maxlength="38"
              aria-required="true" value="{{ old('email') }}" placeholder="Email" autofocus>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
                <div class="invalid-feedback">
                    @if ($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </div>
            </div>
          </div>
          <div class="form-group">
            <label class="label">Senha</label>
            <div class="input-group">
            
              <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
              id="password" name="password" required="required" maxlength="38"
              aria-required="true" value="{{ old('password') }}" placeholder="*********" autofocus>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
                <div class="invalid-feedback">
                    @if ($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </div>
            </div>
          </div>
          <br>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Entrar</button>
          </div>
        
        </form>
      </div>
      
      <p class="footer-text text-center">copyright © 2021 Site. All rights reserved.</p>
    </div>
  </div>
</div>

@endsection