@extends('layout.master')

@push('plugin-styles')
@endpush


<?php
$digits = strtoupper(substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(13))) , 0, 13));

?>

<link rel="stylesheet" href="{{ URL::asset('css/layout226.css') }}">


<style>
        .table th img, .table td img {
    width: 36px;
    height: 36px;
    border-radius: 0% !important;
    }

    i[class^=icon].icon-power-off:before {
            content: "\f011";
        }

        i[class^=icon].icon-launch:before {
            content: "\f135";
        }

        i[class^=icon].icon-star:before {
            content: "\f005";
        }

        .btn-option .icon-power-off.active {
            color: #8dc63f;
        }

        .btn-option .icon-power-off.noactive {
            color: #f12;
        }
  </style>

@section('content')
<div class="row">
  <div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
        
        <div class="row">
          <div class="col-lg-6">
            <h4 class="card-title">Produtos</h4>
          </div>
          <div class="col-lg-6 text-right">
              <a class="btn btn-primary" href="{{ url('/products-add') }}">
                <i class="mdi mdi-plus-circle-outline
                "></i>Adicionar</a>
          </div>


        </div>
        <div class="row">
          <div class="col-lg-12">
            <p class="card-description"> Lista de produtos cadastrados </p>
          </div>
        </div>

        @if(Session::has('message'))
        <div id="alert-success" class="alert {{ Session::get('alert-class', 'alert-success') }}  fade show" role="alert">
          {{ Session::get('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        @if(Session::has('messageUpload'))
        <div id="alert-danger" class="alert {{ Session::get('alert-class', 'alert-danger') }}  fade show" role="alert">
          {{ Session::get('messageUpload') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th> # </th>
                <th> Imagem</th>
                <th> Nome </th>
                <th> Preço </th>
                <th> Estoque </th>
                <th> Link</th>
                <th> Descrição</th>
                <th> Loja</th>
                <th>  </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($products as $key => $item)
                  <td> {{ $key + 1}} </td>

                  <td>
                    <div class="product-photo">
                      <img src="{{route('exibeFotoStore', ['id' => $item->id])}}" alt="image" style="width: 85%; height: 85%;">
                    </div>
                   
                  </td>

                  <td> {{ $item->nome }} </td>
                  <td> {{ $item->preco }} </td>
                  <td> {{ $item->estoque }} </td>
                  <td> {{ $item->link_produto }} </td>
                  <td> {{ $item->descricao }} </td>
                  <td>
                    <div class="group-options">
                      <div class="btn-option toggle-product">
                      <?php 
                          if($item->produtoDisponivel == 1){ ?>
                                  <i class="icon-toggle icon-power-off active"></i>Disponível
                    <?php }else if($item->produtoDisponivel == 0){ ?> 
                                  <i class="icon-toggle icon-power-off noactive"></i>Indisponível
                    <?php } ?>   
                      </div>
                      <div class="btn-option toggle-vitrine">
                        <?php 
                            if($item->produtoVitrine == 1){ ?> 
                                    <i class="icon-toggle icon-star active"></i>Vitrine
                      <?php }else if($item->produtoVitrine == 0){ ?> 
                                    <i class="icon-toggle icon-star noactive"></i>Vitrine
                      <?php } ?>       
            
                        </div>
                      <div class="btn-option toggle-launch">
                      <?php 
                          if($item->produtoLancamento == 1){ ?>
                                  <i class="icon-toggle icon-launch active"></i>Lançamento
                    <?php }else if($item->produtoLancamento == 0){ ?> 
                                  <i class="icon-toggle icon-launch noactive"></i>Lançamento
                    <?php } ?>       
                          
                      </div>
                      


                  </div>
                    
                  </td>
                  <td class="text-center">
                    <a class="btn btn-primary" href="{{route('edit.products', ['id' => $item->id])}}">
                      <i class="mdi mdi-border-color">Editar</i></a>
                      <a class="btn btn-danger" href="{{route('delete.products', ['id' => $item->id])}}">
                        <i class="mdi mdi mdi-delete">Deletar</i></a>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush