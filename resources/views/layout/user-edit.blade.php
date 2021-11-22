@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">




 
  <div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 text-left">
            <p class="card-description"> Usuário: <code  class="card-title text-primary">{{ $user->name }}</code>
            </p>
          </div>
          <div class="col-lg-6 text-right">
            <a class="btn btn-inverse-info btn-fw" href="{{ url()->previous() }}">
              <i class="mdi mdi-keyboard-backspace"></i>Voltar</a>
          </div>
        </div>


        <form method="post" action="/user-alter" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="form-row">
            <div class="form-group col-md-3">
              <input type="hidden" class="form-control" id="id" name="id" value="{{ $user->id }}">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="name">Nome</label>
              <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" 
              value="{{ $user->name}}">
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
              <input type="text" class="form-control" id="login" name="login" value="{{ $user->email }}" readonly>
                <div class="invalid-feedback">
                    @if ($errors->has('login'))
                        {{ $errors->first('login') }}
                     
                    @endif
                </div>
            </div>
          </div>

          <div class="form-row">
            
    

            <div class="form-group col-md-3">
              <label for="password">Nova Senha</label>
              <input type="password" class="form-control {{ $errors->has('newpassword') ? 'is-invalid' : '' }}"
               id="newpassword" name="newpassword"
              value="{{ old('newpassword') }}" placeholder="Nova Senha" autofocus>
              <div class="invalid-feedback">
                @if ($errors->has('newpassword'))
                    {{ $errors->first('newpassword') }}
                @endif
              </div>
            </div>

            <div class="form-group col-md-3">
              <label for="passwordConfirm">Confirmar Senha</label>
              <input type="password" class="form-control {{ $errors->has('passwordConfirm') ? 'is-invalid' : '' }}"
               id="passwordConfirm" name="passwordConfirm"
              value="{{ old('passwordConfirm') }}" placeholder="Confirmar Senha" autofocus>
              <div class="invalid-feedback">
                @if ($errors->has('passwordConfirm'))
                    {{ $errors->first('passwordConfirm') }}
                @endif
            </div>
            

          </div>

        </div>

       
            <button type="submit" class="btn btn-primary btn-fw">
              <i class="mdi mdi-file-document"></i>Alterar</button>

       
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