@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">

 
  <div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">

        <div class="row">
          <div class="col-lg-12 text-right">
            <a class="btn btn-inverse-info btn-fw" href="{{ url()->previous() }}">
              <i class="mdi mdi-keyboard-backspace"></i>Voltar</a>
          </div>
        </div>

        
        <form method="post" action="user-add-confirm" enctype="multipart/form-data">
          {{ csrf_field() }}

          @if(Session::has('message'))
          <div id="alert-warning" class="alert {{ Session::get('alert-class', 'alert-warning') }}  fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="name">Nome</label>
              <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
              id="name" name="name" required="required" maxlength="38"
              aria-required="true" value="{{ old('name') }}" autofocus>
                <div class="invalid-feedback">
                    @if ($errors->has('name'))
                        {{ $errors->first('name') }}
                    @endif
                </div>
            </div>
          </div>

         
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="login">Login</label>
              <input type="email" class="form-control" id="email" name="email"
              required="required" maxlength="38"
              aria-required="true" value="{{ old('email') }}" autofocus>
                <div class="invalid-feedback">
                    @if ($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="password">Senha</label>
              <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
               id="password" name="password" required="required" maxlength="38"
               aria-required="true" value="{{ old('password') }}" 
               placeholder="Senha" autofocus>
              <div class="invalid-feedback">
                @if ($errors->has('password'))
                    {{ $errors->first('password') }}
                @endif
              </div>
            </div>

            <div class="form-group col-md-3">
              <label for="passwordConfirm">Confirmar Senha</label>
              <input type="password" class="form-control {{ $errors->has('passwordConfirm') ? 'is-invalid' : '' }}"
               id="passwordConfirm" name="passwordConfirm"
              placeholder="Nova Senha" required="required" maxlength="38"
              aria-required="true" value="{{ old('passwordConfirm') }}" autofocus>
              <div class="invalid-feedback">
                @if ($errors->has('passwordConfirm'))
                    {{ $errors->first('passwordConfirm') }}
                @endif
            </div>
            

          </div>

        </div>

       
            <button type="submit" class="btn btn-primary btn-fw">
              <i class="mdi mdi-file-document"></i>Confirmar</button>

       
        </form>

      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush