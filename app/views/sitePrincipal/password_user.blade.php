@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">
			
    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">

    				{{ Form::open(array('route'=> 'RemindersController.postRemind', 'class'=>'form', 'method'=>'post')) }}


    					<h3 class="page-header">Por favor informe o seu email para recuperar sua senha.</h3>

    					<hr>
    					<br>

    					<div class="row well">

    						
                            @if(Session::has('message'))
								<div class="form-group text-center text-danger">
								    <p>{{ Session::get('message') }}</p>
								</div>
							@endif

                            @if(Session::has('status'))
								<div class="form-group text-center text-success">
								    <p>{{ Session::get('status') }}</p>
								</div>
							@endif


    						<div class="form-group">

    							{{ Form::Label('email_usuario', 'Email do usuário') }}
			                    {{ Form::email('email_usuario', null, array( 'id'=>'email_usuario', 'class'=>'form-control', 'placeholder'=>'Email para recuperação de senha.')) }}
			                    {{ $errors->first('email_usuario', '<span class=inputError>:message</span>') }}

    						</div>

    						<div class="form-group">
			                    {{ Form::submit('Enviar lembrete de senha', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                </div>

			                <hr>

			                <br>
			                <br>


    					</div>

    				{{ Form::close() }}


    			</div>

    		</div>

		</div>
	</section>

@endsection()