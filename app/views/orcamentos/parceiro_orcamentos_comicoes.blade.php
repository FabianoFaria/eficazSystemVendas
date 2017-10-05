@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="section-heading text-center">
              <h3 class="page-header">Orçamentos indicados por {{ $dadosVendedor->nome_vendedor }}</h3>
              <hr>
            </div>

    		<div class="row">

    			<div class="panel panel-default">


    				<div class="panel-heading">
		        		<div class="row">
		            		<div class="col-lg-6">

		            		</div>
		            		<div class="col-lg-6">
			            		<div id="dataTables-example_filter" class="dataTables_filter pull-right">
				            		<!-- <a class="btn btn-primary" href="{{ url('/orcamentos/create') }}"> 
				            			<i class="fa fa-plus-square "></i> Cadastrar novo orçamento
				            		</a> -->
				            		<a class="btn btn-success" href="{{ url('/') }}"> 
				            			<i class="fa fa-undo"></i> Voltar
				            		</a>
			            		</div>
		            		</div>
		            	</div>
		            </div>

		            <div class="panel-body">

		            	@if( empty($orcamentos))
		            		<h4>Nenhum orçamento concluído ainda.</h4>
		            		<br>
		            		<hr>
		    			@else

		    				<p>
		    					Teste
		    				</p>


		    			@endif


		            </div>

    			</div>

    		</div>

    	</div>
    </section>

@endsection()