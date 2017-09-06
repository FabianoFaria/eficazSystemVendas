
@extends('layouts.main')

@section('content')

<div id="page-wrapper">

	<div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Endereços cadastrados para {{ $dadosVendedor->nome_vendedor }}</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">

    	<div class="panel panel-default">
            <div class="panel-heading">
            	<div class="row">
            		<div class="col-lg-6">

            		</div>
            		<div class="col-lg-6">
	            		<div id="dataTables-example_filter" class="dataTables_filter pull-right">
		            		<a class="btn btn-primary" href="{{ url('/enderecos/create') }}"> 
		            			<i class="fa fa-plus-square "></i> Cadastrar endereço
		            		</a>
	            		</div>
            		</div>
            	</div>
            </div>
            <div class="panel-body">
            	@if( empty($enderecos))
            		<h4>Nenhum endereço cadastrado ainda.</h4>
    			@else

    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

    					<thead>
                            <tr>
                                <th>Logradouro</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Uf</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>

                        	@if(!empty($enderecos))
										
								@foreach($enderecos->all() as $endereco)

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
                                        <a href="{{ URL::to('/enderecos/' . $endereco->id_endereco .'/edit') }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td>
                                        {{ Form::open(array('route' => array('enderecos.destroy', $endereco->id_endereco), 'method' => 'delete')) }}
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
            <div class="panel-footer">             
            </div>
        </div>

   	</div>

    


</div>

@endsection()
