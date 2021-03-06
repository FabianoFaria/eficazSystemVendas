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
				            			<i class="fa fa-user"></i> Cadastrar indicação
				            		</a>

				            		<a class="btn btn-success" href="{{ url('/admin') }}"> 
	                                    <i class="fa fa-undo"></i> Voltar
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
		                                <th>Email cliente</th>
		                                <th>Solicitar Orçamento</th>
		                                <th>Telefones</th>
		                                <th>Endereços</th>
		                                <th>Editar</th>
		                            </tr>
		                        </thead>
		                        <tbody>

		                        	@if(!empty($clientes))
			                     		
			                     		@foreach($clientes as $cliente)

			                     			<tr>

			                     				<td>
			                                        {{ $cliente['Nome'] }}
			                                    </td>
			                                    <td>
			                                        {{ $cliente['Nome_Fantasia'] }}
			                                    </td>
			                                    <td>
			                                        {{ $cliente['Email'] }}
			                                    </td>
			                                    <td>
			                                        <a href="{{ URL::to('/orcamentos/' . $cliente['Cadastro_ID'] ) }}" class="btn btn-info"><i class="fa fa-money"></i></a>
			                                    </td>
			                                    <td>
			                                        <a href="{{ URL::to('/telefones_indicacoes/' . $cliente['Cadastro_ID'] ) }}" class="btn btn-primary"><i class="fa fa-phone"></i></a>
			                                    </td>
			                                    <td>
			                                        <a href="{{ URL::to('/enderecos_indicacoes/' . $cliente['Cadastro_ID'] ) }}" class="btn btn-success"><i class="fa fa-list-alt"></i></a>
			                                    </td>
			                                    <td>
			                                        <a href="{{ URL::to('/indicacoes/' . $cliente['Cadastro_ID'] .'/edit') }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
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