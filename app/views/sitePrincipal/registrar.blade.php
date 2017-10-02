
@extends('layouts.main_site')

@section('content')


	
	<section class="cta register_page">
        <div class="cta-content">
	        <div class="container">
	            <div class="row">

	            	<div class="col-md-7">

	            	</div>

	            	<div class="col-md-5">

	            		{{ Form::open(array('route'=> 'users.nova_parceria', 'class'=>'form form-signup-parceiro', 'method'=>'POST')) }}

	            			<h3 class="novoParceiroTitulo">Crie sua conta e seja um novo parceiro.</h3>

	            			<div class="row">
	            			 	
	            			 	<div class="form-group">

	            			 		<!-- <label for="nomeCliente">Nome do usuário</label> -->
		                        	{{ Form::Label('nomeCliente', 'Nome do usuário') }}
		                        	{{ Form::text('nomeCliente', null, array( 'id'=>'nomeCliente', 'class'=>'form-control', 'placeholder'=>'Nome do usuário')) }}
		                        	{{ $errors->first('nomeCliente', '<span class=inputError>:message</span>') }}

	            			 	</div>

	            			 	<div class="form-group">

	            			 		<label for="emailEnd">Email do usuário</label>
                        			{{ Form::text('email', null, array('id'=>'email', 'class'=>'form-control', 'placeholder'=>'Email do usuário')) }}
                        			{{ $errors->first('email') }}

	            			 	</div>


	            			 	<div class="form-group">

	            			 		<label for="senhaNovoUsuario">Senha do usuário</label>
			                        {{ Form::password('senhaNovoUsuario', array( 'id'=>'senhaNovoUsuario', 'class'=>'form-control', 'placeholder'=>'Senha')) }}
			                        {{ $errors->first('senhaNovoUsuario') }}

	            			 	</div>

	            			 	<div class="form-group">

	            			 		<label for="confirmaSenhaNovoUsuario">Confirmação da senha do usuário</label>
                        			{{ Form::password('confirmaSenhaNovoUsuario', array('id'=>'confirmaSenhaNovoUsuario', 'class'=>'form-control', 'placeholder'=>'Confirmação da senha')) }}
                        			{{ $errors->first('confirmaSenhaNovoUsuario') }}

	            			 	</div>

	            			 	<div class="form-group">

	            			 		{{ Form::submit('Cadastrar', array('class'=>'btn btn-large btn-primary btn-block'))}}

	            			 	</div>

	            			</div>

	            		{{ Form::close() }}

	            	</div>

	            </div>
	            <div class="row">
	            	
	            </div>
	        </div>
        </div>
    </section>
	


@endsection()
