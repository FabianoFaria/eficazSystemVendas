@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">


    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">


    				{{ Form::open(array('route'=> 'RemindersController.postReset', 'class'=>'form', 'method'=>'post')) }}

    					{{ Form::hidden('token', $token, array('id' => 'token')) }}

    					<div class="form-group">
	                       	{{ Form::Label('email', 'Email usuário.') }} *Obrigatório
			               	{{ Form::text('email', null, array( 'id'=>'email', 'class'=>'form-control', 'placeholder'=>'Email cliente')) }}
			                {{ $errors->first('email', '<span class=inputError>:message</span>') }}
	                    </div>

	                    <div class="form-group">
	                       	{{ Form::Label('password', 'Senha do cliente.') }} *Obrigatório
			               	{{ Form::password('password', null, array( 'id'=>'password', 'class'=>'form-control', 'placeholder'=>'Senha do cliente')) }}
			                {{ $errors->first('password', '<span class=inputError>:message</span>') }}
	                    </div>

	                    <div class="form-group">
	                       	{{ Form::Label('password_confirmation', 'Email usuário.') }} *Obrigatório
			               	{{ Form::password('password_confirmation', null, array( 'id'=>'password_confirmation', 'class'=>'form-control', 'placeholder'=>'Confirmação de senha.')) }}
			                {{ $errors->first('password_confirmation', '<span class=inputError>:message</span>') }}
	                    </div>

    					<div class="form-group">
			                {{ Form::submit('Salvar nova senha', array('class'=>'btn btn-large btn-primary btn-block'))}}
			            </div>

    				{{ Form::close() }}

    			</div>

    		</div>

		</div>
	</section>	

@endsection()