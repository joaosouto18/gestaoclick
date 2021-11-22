@extends('layout.master')

@push('plugin-styles')
@endpush



@section('content')
<div class="row">
  <div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
        
        <div class="row">
          <div class="col-lg-6">
            <h4 class="card-title">Usuários</h4>
          </div>
          <div class="col-lg-6 text-right">
              <a class="btn btn-primary" href="{{ url('user-add') }}">
                <i class="mdi mdi mdi-account-plus"></i>Adicionar</a>
          </div>

          


        </div>
        <div class="row">
          <div class="col-lg-12">
            <p class="card-description"> Lista de usuários cadastrados </p>
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

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th> # </th>
                <th> User </th>
                <th> Nome </th>
                <th> Login </th>
                <th>  </th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-success">
                @foreach ($users as $key => $item)
                  <td> {{ $key + 1}} </td>
                  <td class="py-1">
                    <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image" /> 
                  </td>
                  <td> {{ $item->name }} </td>
                  <td> {{ $item->email }} </td>
                  <td class="text-center">
                    <a class="btn btn-primary" href="{{route('edit', ['id' => $item->id])}}">
                      <i class="mdi mdi-border-color">Editar</i></a>
                      <a class="btn btn-danger" href="{{route('delete', ['id' => $item->id])}}">
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