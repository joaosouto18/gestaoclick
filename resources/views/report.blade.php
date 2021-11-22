@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush


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

        <div class="col-sm-6 col-md-6 col-lg-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-5 d-flex align-items-center">
                    <canvas id="UsersDoughnutChart" class="400x160 mb-4 mb-md-0" height="200"></canvas>
                  </div>
                  <div class="col-md-7">
                    <h4 class="card-title font-weight-medium mb-0 d-none d-md-block">Report</h4>
                    <div class="wrapper mt-4">
                      <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                          <p class="mb-0 font-weight-medium">{{$qtdUsers}}</p>
                          <small class="text-muted ml-2">Usuário</small>
                        </div>
                        <p class="mb-0 font-weight-medium">80%</p>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                    <div class="wrapper mt-4">
                      <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                          <p class="mb-0 font-weight-medium">{{$qtdProducts}}</p>
                          <small class="text-muted ml-2">Produtos</small>
                        </div>
                        <p class="mb-0 font-weight-medium">34%</p>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

      
      

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
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush