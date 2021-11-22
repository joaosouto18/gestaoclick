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
                <div id="alert-warning" class="alert {{ Session::get('alert-class', 'alert-warning') }}  fade show"
                    role="alert">
                    {{ Session::get('messageExists') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <?php
        $digits = strtoupper(substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(13))) , 0, 13));
        
        ?>

                <form method="post" action="/products-alter" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $products->id }}">
                            <input type="hidden" id="data_input" name="data_input"
                                value="{{ date('Y-m-d',strtotime($products->validade))}}" /><br />
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                                id="nome" name="nome" value="{{ old('nome', $products->nome) }}" required="required"
                                maxlength="38" aria-required="true" autofocus>
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
                            <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}"
                                id="descricao" name="descricao" rows="4" maxlength="500" required="required"
                                autofocus>{{ old('descricao', $products->descricao) }}</textarea>
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
                            <label for="preco">Preço</label>
                            <input type="text" class="form-control {{ $errors->has('preco') ? 'is-invalid' : '' }}"
                                id="preco" name="preco" maxlength="6" value="{{ old('preco', $products->preco) }}"
                                autofocus>
                            <div class="invalid-feedback">
                                @if ($errors->has('preco'))
                                {{ $errors->first('preco') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="precoPromo" class="label-block">Preço Promocional<span
                                    title="Campo obrigatório">*</span></label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control {{ $errors->has('precoPromo') ? 'is-invalid' : '' }}"
                                    id="precoPromo" name="precoPromo" maxlength="6"
                                    value="{{ old('precoPromo', $products->precoPromo) }}" autofocus>
                                <div class="invalid-feedback">
                                    @if ($errors->has('precoPromo'))
                                    {{ $errors->first('precoPromo') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="estoque" class="label-block">Qtd. de Produtos<span
                                    title="Campo obrigatório">*</span></label>
                            <div class="input-group">
                                <input type="number" min="1" max="1000"
                                    class="form-control {{ $errors->has('estoque') ? 'is-invalid' : '' }}"
                                    aria-label="Amount (to the nearest dollar)" id="estoque" name="estoque"
                                    value="{{ old('estoque', $products->estoque) }}" required="required" autofocus />
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="lote">Lote</label>
                            <input type="text" class="form-control {{ $errors->has('lote') ? 'is-invalid' : '' }}"
                                id="lote" name="lote" required="required" maxlength="38" aria-required="true"
                                value="{{ old('lote', $products->lote) }}" autofocus>
                            <div class="invalid-feedback">
                                @if ($errors->has('lote'))
                                {{ $errors->first('lote') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="validade">Validade</label>
                            <input type="date" id="validade"
                                class="form-control datepicker {{ $errors->has('validade') ? 'is-invalid' : '' }}"
                                name="validade" id="validade" value="{{ old('validade', $products->validade) }}"
                                required="required" autofocus />
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
                                <span class="form-control input-group-text">https://example.com/users/</span>
                                <input type="text" class="form-control input-group"
                                    value="{{ old('slug', $products->link_produto) }}" name="slug" id="slug" autofocus
                                    required="required" />
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
                            <input name="sku" maxlength="50" type="text" value="{{ old('sku', $products->sku) }}"
                                id="sku" class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" readonly
                                autofocus>
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
                            <input type="checkbox" id="produtoDisponivel" name="produtoDisponivel" value="on"
                                {{$products->produtoDisponivel == 1 ? 'checked' : ''}}>
                            <label for="produtoDisponivel"><span class="icon-check"></span>Disponível</label>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="checkbox" id="produtoVitrine" name="produtoVitrine" value="on"
                                {{$products->produtoVitrine == 1 ? 'checked' : ''}}>
                            <label for="produtoVitrine">
                                <span class="icon-star"> </span>Mostrar na Vitrine
                        </div>
                        <div class="form-group col-md-2">
                            <input type="checkbox" id="produtoLancamento" name="produtoLancamento" value="on"
                                {{$products->produtoLancamento == 1 ? 'checked' : ''}}>
                            <label for="produtoLancamento">
                                <span class="icon-star"> </span>Lançamento
                        </div>
                    </div>

                    <hr>




                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="foto">Imagem do Produto</label>
                            <input type="file" name="imgInp" id="imgInp"
                                class="form-control-file {{ $errors->has('imgInp') ? 'is-invalid' : '' }}"
                                value="{{ old('imgInp')}}">
                            <div class="invalid-feedback">
                                @if ($errors->has('foto'))
                                {{ $errors->first('foto') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(Session::has('messageFoto'))
                    <div id="alert-danger" class="alert {{ Session::get('alert-class', 'alert-danger') }}  fade show"
                        role="alert">
                        {{ Session::get('messageFoto') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif




                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="text-center">
                                <img id='img-upload' name="img-upload"
                                    src="{{route('exibeFotoStore', ['id' => $products->id])}}" alt="image"
                                    style="width: 100%; height: 100%;">
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
    $(function () {

        if ($('#produtoDisponivel').is(':checked') === true) {
            document.getElementById("produtoDisponivel").checked = true
        }

        if ($('#produtoVitrine').is(':checked') === true) {
            document.getElementById("produtoVitrine").checked = true
        }
        if ($('#produtoLancamento').is(':checked') === true) {
            document.getElementById("produtoLancamento").checked = true
        }

        $validade = $("#data_input").val();
        $("#validade").val($validade);


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
