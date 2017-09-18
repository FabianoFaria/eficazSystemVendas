@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="section-heading text-center">
	          <h3 class="page-header">Contas bancarias cadastrados para {{ $dadosVendedor->nome_vendedor }}</h3>
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
				            		<a class="btn btn-primary" href="{{ url('/financas/create') }}"> 
				            			<i class="fa fa-plus-square "></i> Cadastrar conta bancaria
				            		</a>
			            		</div>
		            		</div>
		            	</div>
		            </div>

		            <div class="panel-body">

		            	@if( empty($contas))
		            		<h4>Nenhuma conta bancaria cadastrada ainda.</h4>
		    			@else

		    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

		    					<thead>
		                           	<tr>
		                                <th>Nome conta</th>
		                                <th>Número</th>
		                                <th>Tipo conta</th>
		                                <th>Instituição</th>
		                                <th>Editar</th>
		                                <th>Excluir</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	@if(!empty($contas))
										
										@foreach($contas->all() as $conta)

											<tr>
			                                    <td>
			                                        {{ $conta->nome_conta }}
			                                    </td>
			                                    <td>
			                                        {{ $conta->numero_conta }}
			                                    </td>
			                                    <td>
			                                        @foreach($tipo_contas->all() as $tipo_conta)

			                                            @if($tipo_conta->id_tipo_conta == $conta->tipo_conta)
			                                                {{ $tipo_conta->tipo_conta }}
			                                            @endif

			                                        @endforeach
			                                    </td>
			                                    <td>
			                                        @foreach($lista_bancos->all() as $banco)

			                                            @if($banco->id_instituicao_bancaria == $conta->instituicao )
			                                                {{ $banco->nome_instituicao_bancaria }}
			                                            @endif

			                                        @endforeach
			                                    </td>
			                                    <td>
			                                        <a href="{{ URL::to('/financas/' . $conta->id_conta_vendedor .'/edit') }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
			                                    </td>
			                                    <td>
			                                        {{ Form::open(array('route' => array('financas.destroy', $conta->id_conta_vendedor), 'method' => 'delete')) }}
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