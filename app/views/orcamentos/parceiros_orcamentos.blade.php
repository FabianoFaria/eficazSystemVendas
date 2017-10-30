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
		            		<h4>Nenhum orçamento cadastrado ainda.</h4>
		    			@else

		    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

		    					<thead>
		                            <tr>
		                            	<th>Empresa</th>
		                                <th>Título</th>
		                                <th>Data de abertura</th>
		                                <th>Status</th>
		                            </tr>
		                        </thead>
		                        <tbody>

		                        	@if(!empty($orcamentos))

		                        		@foreach($orcamentos as $orcamento)

		                        			<tr>
		                        				<td>
				                        			{{ $orcamento['Nome'] }}
				                        		</td>
				                        		<td>
				                        			{{ $orcamento['Titulo'] }}
				                        		</td>
				                        		<td>
				                        			{{--*/ 
				                        				$data  = $orcamento['Data_Abertura'];
				                        				$teste = explode(' ',$data); 
				                        				echo implode('/',array_reverse(explode('-', $teste[0])));
				                        			/*--}}
				                        		</td>
				                        		<td>
				                        			{{ $orcamento['Status'] }}
				                        		</td>
				                        	<tr>


		                        		@endforeach

		                        	@endif

		                        </tbody>
		    				</table>

		    			@endif

		            </div>

            	</div>
            </div>

    	</div>
    </section>
    <hr>
@endsection()