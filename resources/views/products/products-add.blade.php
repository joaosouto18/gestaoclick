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


        
        @if(Session::has('messageExists'))
        <div class="alert {{ Session::get('alert-class', 'alert-warning') }}  fade show" role="alert">
          {{ Session::get('messageExists') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        @if(Session::has('messageFoto'))
        <div class="alert {{ Session::get('alert-class', 'alert-warning') }}  fade show" role="alert">
          {{ Session::get('messageFoto') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <?php
        $digits = strtoupper(substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(13))) , 0, 13));
        
        ?>

        <form method="post" action="/products-add-confirm" enctype="multipart/form-data">
          {{ csrf_field() }}        

           <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" 
                id="nome" name="nome" maxlength="38"
                aria-required="true" value="{{ old('nome') }}" autofocus>
                  <div class="invalid-feedback">
                      @if ($errors->has('nome'))
                          {{ $errors->first('nome') }}
                      @endif
                  </div>
              </div>
          </div>
        
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="descricao">Descrição</label>
                <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" id="descricao"
                  name="descricao" rows="4" maxlength="500" required="required" autofocus>{{ old('descricao') }}</textarea>
                <div class="invalid-feedback">
                    @if ($errors->has('descricao'))
                        {{ $errors->first('descricao') }}
                    @endif
                </div>
            </div>
          </div>
              
          <hr>
          

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="preco" class="label-block">Preço<span title="Campo obrigatório">*</span></label>
              <input type="text" class="form-control {{ $errors->has('preco') ? 'is-invalid' : '' }}" aria-label="Amount (to the nearest dollar)"
                         id="preco"  name="preco" maxlength="6" placeholder="0.00"
                   value="{{ old('preco')}}" autofocus>
                <div class="invalid-feedback">
                    @if ($errors->has('preco'))
                        {{ $errors->first('preco') }}
                    @endif
                </div>
            </div>
            <div class="form-group col-md-3">
              <label for="precoPromo" class="label-block">Preço Promocional<span title="Campo obrigatório">*</span></label>
              <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('precoPromo') ? 'is-invalid' : '' }}" placeholder="0.00"
                    aria-label="Amount (to the nearest dollar)"
                          id="precoPromo"  name="precoPromo" maxlength="6"
                          value="{{ old('precoPromo')}}" autofocus>
                  <div class="invalid-feedback">
                              @if ($errors->has('precoPromo'))
                                  {{ $errors->first('precoPromo') }}
                              @endif
                  </div>
              </div>
            </div>
            <div class="form-group col-md-3">
                <label for="estoque" class="label-block">Qtd. de Produtos<span title="Campo obrigatório">*</span></label>
                <div class="input-group">
                  <input type="number" min="1" max="1000" class="form-control {{ $errors->has('estoque') ? 'is-invalid' : '' }}" aria-label="Amount (to the nearest dollar)"
                          id="estoque"  name="estoque"
                          value="{{ old('estoque')}}" autofocus />
                </div>
            </div>
          </div>
        
     
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="lote">Lote</label>
              <input type="text" class="form-control {{ $errors->has('lote') ? 'is-invalid' : '' }}" 
                id="lote" name="lote" maxlength="38"
                aria-required="true" value="{{ old('lote') }}" autofocus>
                  <div class="invalid-feedback">
                      @if ($errors->has('lote'))
                          {{ $errors->first('lote') }}
                      @endif
                  </div>
            </div>
            <div class="form-group col-md-3">
              <label for="validade">Validade</label>
              <input type="date" class="form-control datepicker {{ $errors->has('validade') ? 'is-invalid' : '' }}"
                            name="validade" id="validade" value="{{ old('validade') }}" autofocus/>
                            <div class="invalid-feedback">
                                        @if ($errors->has('validade'))
                                            {{ $errors->first('validade') }}
                                        @endif
                            </div>
            </div>
            <div class="form-group col-md-3">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="slug">Link do Produto:</label>
              <div class="input-group-prepend">
                <span class="form-control input-group-text" id="basic-addon3">https://example.com/users/</span>
                <input type="text" value="{{ old('slug') }}" class="form-control input-group  {{ $errors->has('slug') ? 'is-invalid' : '' }}" name="slug" id="slug" aria-describedby="basic-addon3"/>
                  <div class="invalid-feedback">
                    @if ($errors->has('slug'))
                        {{ $errors->first('slug') }}
                    @endif
                  </div>
              </div>
            </div>
          </div>

          <hr>

        
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="sku">SKU (Automático)</label>
              <input name="sku" maxlength="50" type="text" value="{{$digits}}" id="sku" 
              class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" readonly autofocus>
            </div>
            <div class="form-group col-md-3">
        
            </div>
            <div class="form-group col-md-3">
        
            </div>
          </div>

<hr>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="sku">Selecione opções para visualização no seu produto no site:</label>
            </div>
            
            <div class="form-group col-md-2">
              <input type="checkbox" name="produtoDisponivel" value="1"  {{ old('produtoDisponivel') ? 'checked="checked"' : '' }} id="produtoDisponivel">
              <label for="produtoDisponivel"><span class="icon-check"></span>Disponível</label>  
            </div>
            <div class="form-group col-md-2">
              <input type="checkbox" name="produtoVitrine" value="1" {{ old('produtoVitrine') ? 'checked="checked"' : '' }}  id="produtoVitrine">
              <label for="produtoVitrine">
              <span class="icon-star"> </span>Mostrar na Vitrine
            </div>
            <div class="form-group col-md-2">
              <input type="checkbox" name="produtoLancamento" value="1" {{ old('produtoLancamento') ? 'checked="checked"' : '' }}  id="produtoLancamento">
              <label for="produtoLancamento">
              <span class="icon-star"> </span>Lançamento
            </div>
          </div>
          
          <hr>

          
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="foto">Imagem do Produto</label>
              <input type="file" name="imgInp" id="imgInp" class="form-control-file {{ $errors->has('imgInp') ? 'is-invalid' : '' }}"
                     value="{{ old('imgInp')}}">

                  <div class="invalid-feedback">
                         @if ($errors->has('imgInp'))
                             {{ $errors->first('imgInp') }}
                         @endif
                 </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <div class="text-center">
                <img id='img-upload' name="img-upload"
                 src="{{ url('assets/images/carousel/banner_1.jpg') }}" 
                 class="img-fluid img-thumbnail" alt="image" style="width: 100%; height: 100%;">
              </div>
            </div>
            <div class="form-group col-md-4">
        
            </div>
            <div class="form-group col-md-4">
        
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


<script src="https://code.jquery.com/jquery-1.9.1.js"></script>

<script>



$(document).ready(function () {

  if($('#produtoDisponivel').is(':checked') === true){
      document.getElementById("produtoDisponivel").checked = true
    }

    if($('#produtoVitrine').is(':checked') === true){
      document.getElementById("produtoVitrine").checked = true
    }
    if($('#produtoLancamento').is(':checked') === true){
      document.getElementById("produtoLancamento").checked = true
    }

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#img-upload').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function () {
			readURL(this);
        });
});
 
     
  
  
  </script>
  
  

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush