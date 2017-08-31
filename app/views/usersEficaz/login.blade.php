
@extends('layouts.login')

@section('content')

	<div class="row">
		<div class="col-md-5 col-md-offset-4">

			 <div class="login-panel panel">

			 	<div class="panel-heading">
			 		<div class="imgLogin">
			 			<img src="{{ URL::asset('img/eficazlogo.jpg') }}">
			 		</div>
                    <h3 class="panel-title">Identifique-se</h3>
                </div>
                <div class="panel-body">

                	<!-- {{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }} -->
                	<!-- Enviando para a rota Sessions -> store -->
                	{{ Form::open(['route'=>'sessions.store', 'class'=>'form-signin']) }}

                		<div class="form-group">
                			{{ Form::text('email_usuario', null, array('id' => 'email_usuario','class'=>'form-control', 'placeholder'=>'Email Cadastrado')) }}
                		</div>
                		<div class="form-group">
                			{{ Form::password('senha_usuario', array('id' => 'senha_usuario','class'=>'form-control', 'placeholder'=>'Senha de acesso')) }}
                		</div>
                		
                		{{ Form::submit('Entrar', array('class'=>'btn btn-lg btn-success btn-block'))}}

                		{{ $errors->first('message') }}

                	{{ Form::close() }}
                </div>
			 </div>

		</div>
	</div>


@endsection()



