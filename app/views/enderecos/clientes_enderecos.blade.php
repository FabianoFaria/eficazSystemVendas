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
				            		<a class="btn btn-primary" href="{{ url('/enderecos_indicacoes/create') }}"> 
				            			<i class="fa fa-plus-square "></i> Cadastrar endereço
				            		</a>
				            		<a class="btn btn-success" href="{{ url('/indicacoes') }}"> 
				            			<i class="fa fa-undo"></i> Voltar
				            		</a>
			            		</div>
		            		</div>
		            	</div>
		            </div>

		            <div class="panel-body">

		            	@if( empty($enderecos))
		            		<h4>Nenhum Endereço cadastrado ainda.</h4>
		    			@else

		    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

		    					<thead>
		                            <tr>
		                                <th>Logradouro</th>
		                                <th>Bairro</th>
		                                <th>Cidade</th>
		                                <th>Estado</th>
		                                <th>Editar</th>
		                                <th>Excluir</th>
		                            </tr>
		                        </thead>
		                        <tbody>

		                        	@if(!empty($enderecos))

		                        		@foreach($enderecos as $endereco)

		                        			<tr>
		                        				<td>
		                        					{{ $endereco->logradouro }}
		                        				</td>
		                        				<td>
		                        					{{ $endereco->bairro }}
		                        				</td>
		                        				<td>
		                        					{{ $endereco->cidade }}
		                        				</td>
		                        				<td>
		                                            @foreach($estados->all() as $estado)

		                                                @if($estado->id_estado == $endereco->uf)
		                                                    {{ $estado->nome_estado }}
		                                                @endif

		                                            @endforeach
		                                        </td>
		                        				<td>
		                                            <a href="{{ URL::to('/enderecos_indicacoes/' . $endereco->id_cliente_endereco .'/edit') }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
		                                        </td>
		                                        <td>
		                                            {{ Form::open(array('route' => array('enderecos_indicacoes.destroy', $endereco->id_cliente_endereco), 'method' => 'delete')) }}
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