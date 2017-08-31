
@extends('layouts.main')

@section('content')


	<div id="page-wrapper">
	

		<div class="row">	

			<div class="col-lg-12">

				<h3> Lista de usuários ativos</h3>

			</div>

		</div>
		<div class="row">

			<div class="panel panel-default">

				<div class="panel-heading">
                   	
                </div>
                <div class="panel-body">

                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">

	                <div class="row">
	                	<div class="col-sm-6">
	                   	</div>
	                   	<div class="col-sm-6">
	                   		<!--  local para barra de pesquisa
								
								
	                   		-->
	                   		<div id="dataTables-example_filter" class="dataTables_filter">
	                   			<label>
	                   				Pesquisar : <input type="search" name="pesquisar_usuario" class="form-control input-sm">
	                   			</label>
	                   		</div>
	                   	</div>
	                </div>

	                 <div class="row">

	                 	<div class="col-lg-12">

	                 		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

	                 			<thead>
                                    <tr>
                                        <th>Nome Usuário</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>

                                	@if(!empty($usuariosAtivos))
										
										@foreach($usuariosAtivos as $usuario)

											<tr>
                                				<td>{{ $usuario->nome_usuario }}</td>
                                				<td>{{ $usuario->email_usuario }}</td>
                                				<td>
                                					@foreach($status_users as $nivel)

                                						@if($nivel->id_status == $usuario->status)

                                							<p>{{ $nivel->status_usuario }}</p>

                                						@endif

                                					@endforeach
                                				</td>
                                				<td>
													<a href="{{ URL::to('/users/' . $usuario->id .'/edit') }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                				</td>

                                				<td>
                                					
                                					{{ Form::open(array('route' => array('users.destroy', $usuario->id), 'method' => 'delete')) }}
													    <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
													{{ Form::close() }}
                                				</td>
                                			</tr>

                                		@endforeach

                                	@else

                                		<tr>
                                			<td colspan="4">Nenhum usuário encontrado. </td>
                                		</tr>

									@endif

                                </tbody>
	                 		</table>

	                   	</div>

	                </div>

                </div>
			</div>

		</div>

	</div>

@endsection()