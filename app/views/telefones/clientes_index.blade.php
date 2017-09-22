@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="section-heading text-center">

    			@if( $dadosCliente->nome_fantasia_cliente != '')

    				<h3 class="page-header">Telefones cadastrados para {{ $dadosCliente->nome_fantasia_cliente }}</h3>

    			@else

    				<h3 class="page-header">Telefones cadastrados para {{ $dadosCliente->nome_completo }}</h3>

    			@endif

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
				            		<a class="btn btn-primary" href="{{ url('/telefones_indicacoes/create') }}"> 
				            			<i class="fa fa-plus-square "></i> Cadastrar telefone
				            		</a>
			            		</div>
		            		</div>
		            	</div>
		            </div>

		            <div class="panel-body">

		            	@if( empty($telefones))
		            		<h4>Nenhum telefone  cadastrado ainda.</h4>
		    			@else

		    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

		    					<thead>
		                            <tr>
		                                <th>Telefone</th>
		                                <th>Observação</th>
		                                <th>Editar</th>
		                                <th>Excluir</th>
		                            </tr>
		                        </thead>

		                        <tbody>

		                        	@if(!empty($telefones))
			                     		
			                     		@foreach($telefones as $telefone)

			                     			<tr>
			                                    <td>
			                                        {{ $telefone->telefone_cliente }}
			                                    </td>
			                                    <td>
			                                        {{ $telefone->observacao_telefone }}
			                                    </td>
			                                    <td>
			                                        <a href="{{ URL::to('/telefones_indicacoes/' . $telefone->id_cliente_telefone .'/edit') }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
			                                    </td>
			                                    <td>
			                                        {{ Form::open(array('route' => array('telefones_indicacoes.destroy', $telefone->id_cliente_telefone), 'method' => 'delete')) }}
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