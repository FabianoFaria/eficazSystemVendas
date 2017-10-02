@extends('layouts.main_site')

@section('content')


	<section class="features" id="features">
    	<div class="container">

    		<div class="row">
				<div class="col-md-12">

					<h3 class="page-header">Dados gerais do usuário {{ $usuario->nome_usuario }}</h3>
	          			
	          		<hr>
				</div>
			</div>

			<div class="row">

				<div class="col-md-6 col-md-offset-3">

					{{ Form::open(array('route'=> array('users.update', $usuario->id), 'method'=> 'PUT', 'class'=>'form')) }}


						<h3 class="form-signup-heading">Edição de dados do usuário</h3>

						<div class="row well">


							<div class="form-group">

		                        {{ Form::hidden('id_usuario', $usuario->id, array('id' => 'id_usuario')) }}

		                        {{ Form::hidden('status_usuario', $usuario->status, array('id' => 'status_usuario')) }}

		                        <!-- <label for="nomeCliente">Nome do usuário</label> --> 
		                        {{ Form::Label('nomeCliente', 'Nome do usuário') }}
		                        {{ Form::text('nomeCliente', $usuario->nome_usuario, array( 'id'=>'nomeCliente', 'class'=>'form-control', 'placeholder'=>'Nome do usuário')) }}
		                        {{ $errors->first('nomeCliente', '<span class=inputError>:message</span>') }}
		                    </div>

							<div class="form-group">
		                        <label for="emailEnd">Email do usuário</label>
		                        {{ Form::text('emailEnd', $usuario->email_usuario, array('id'=>'emailEnd', 'class'=>'form-control', 'placeholder'=>'Email do usuário')) }}
		                        {{ $errors->first('emailEnd') }}
		                    </div>

		                    <div class="form-group">
		                        <label for="senhaUsuario">Senha do usuário</label>
		                        {{ Form::password('senhaUsuario', array( 'id'=>'senhaUsuario', 'class'=>'form-control', 'placeholder'=>'Senha')) }}
		                        {{ $errors->first('senhaUsuario') }} 
		                    </div>

		                    <div class="form-group">
		                        <label for="confirmaSenhaUsuario">Confirmação senha</label>
		                        {{ Form::password('confirmaSenhaUsuario', array('id'=>'confirmaSenhaUsuario', 'class'=>'form-control', 'placeholder'=>'Confirmação da senha')) }}
		                        {{ $errors->first('confirmaSenhaUsuario') }}
		                    </div>

		                    <div class="form-group">
		                        {{ Form::submit('Atualizar', array('class'=>'btn btn-large btn-primary btn-block'))}}
		                    </div>

		                    <div>
		                        <a href="{{ URL::to('/users/' . Session::get('id_atual')) }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
		                    </div>

						</div>

					{{ Form::close() }}

				</div>

			</div>

    	</div>

    </section>

@endsection()