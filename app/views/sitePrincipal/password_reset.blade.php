@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">


    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">

    				<!-- <input name="_method" type="hidden" value="PUT"> -->
    				<h3 class="page-header">Por favor informe o seu email e a nova senha para cadastrar.</h3>

    				<hr>
    				<br>


    				{{ Form::open(array('route'=> 'RemindersController.postReset', 'class'=>'form', 'method'=>'post')) }}

    					
    					{{ Form::hidden('token', $token, array('id' => 'token')) }}
						
						<div class="form-group">

							@if(Session::has('errorResposta'))
								<div class="form-group text-center text-danger">
								    <p>{{ Session::get('errorResposta') }}</p>
								</div>
							@endif

							
						</div>

    					<div class="form-group">
	                       	{{ Form::Label('email_usuario', 'Email usuário.') }} *Obrigatório
			               	{{ Form::email('email_usuario', null, array( 'id'=>'email_usuario', 'class'=>'form-control', 'placeholder'=>'Email cliente')) }}
			                {{ $errors->first('email_usuario', '<span class=inputError>:message</span>') }}
	                    </div>

	                    <div class="form-group">

			                {{ Form::Label('password', 'Senha do usuário.') }} *Obrigatório
			                <input type="password" name="password" class="form-control" placeholder="Nova senha de usuário">
    						{{ $errors->first('password', '<span class=inputError>:message</span>') }}

	                    </div>

	                    <div class="form-group">
	                       	{{ Form::Label('password_confirmation', 'Confirmação da senha.') }} *Obrigatório
			               	<input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar senha de usuário">

			                {{ $errors->first('password_confirmation', '<span class=inputError>:message</span>') }}
	                    </div>

    					<div class="form-group">
			                {{ Form::submit('Salvar nova senha', array('class'=>'btn btn-large btn-primary btn-block'))}}
			            </div>


			            <hr>

    				{{ Form::close() }}

    			</div>

    		</div>

		</div>
	</section>	

@endsection()