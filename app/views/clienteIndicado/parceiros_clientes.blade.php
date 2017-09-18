@extends('layouts.main_site')

@section('content')

	
	<section class="features" id="features">
    	<div class="container">

    		<div class="section-heading text-center">
	          <h3 class="page-header">Clientes indicados por {{ $dadosVendedor->nome_vendedor }}</h3>
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
				            		<a class="btn btn-primary" href="{{ url('/indicacoes/create') }}"> 
				            			<i class="fa fa-plus-square "></i> Cadastrar indicação
				            		</a>
			            		</div>
		            		</div>
		            	</div>
		            </div>
		            <div class="panel-body">
		            	@if( empty($clientes))
		            		<h4>Nenhum cliente indicado ainda.</h4>
		    			@else

		    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

		    					<thead>
		                            <tr>
		                                <th>Nome completo</th>
		                                <th>Nome fantasia</th>
		                                <th>Data nscimento/criação</th>
		                                <th>Editar</th>
		                                <th>Excluir</th>
		                            </tr>
		                        </thead>
		                        <tbody>

		                        	@if(!empty($clientes))
			                     		
			                     		@foreach($clientes->all() as $cliente)

			                     			<tr>

			                     				<td>
			                                        {{ $cliente->telefone }}
			                                    </td>
			                                    <td>
			                                        {{ $cliente->observacacao_telefone }}
			                                    </td>
			                                    <td>
			                                        <a href="{{ URL::to('/indicacoes/' . $cliente->id_cliente_indicado .'/edit') }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
			                                    </td>
			                                    <td>
			                                        {{ Form::open(array('route' => array('indicacoes.destroy', $cliente->id_cliente_indicado), 'method' => 'delete')) }}
			                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
			                                        {{ Form::close() }}
			                                    </td>

			                     			</tr>

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

@endsection()