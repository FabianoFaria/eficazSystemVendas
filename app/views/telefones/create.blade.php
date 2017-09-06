
@extends('layouts.main')

@section('content')

	<div id="page-wrapper">

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			
			{{ Form::open(array('route'=> 'telefones.store', 'class'=>'form')) }}
	            <h3 class="form-signup-heading">Cadastro de novo telefone de usuário.</h3>

	            <div class="row well">


	            	<div class="form-group">
	            		{{ Form::hidden('id_usuario', $dadosVendedor->id_user, array('id' => 'id_usuario')) }}	

	                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
	                    {{ Form::Label('telefone', 'Telefone') }}
	                    {{ Form::text('telefone', null, array( 'id'=>'telefone', 'class'=>'form-control', 'placeholder'=>'Número do telefone')) }}
	                    {{ $errors->first('telefone', '<span class=inputError>:message</span>') }}
	                </div>

	                <div class="form-group">
	                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
	                    {{ Form::Label('observacao', 'Observação') }}
	                    {{ Form::textarea('observacao', null, array( 'id'=>'observacao', 'class'=>'form-control', 'placeholder'=>'Observações do número')) }}
	                    {{ $errors->first('observacao', '<span class=inputError>:message</span>') }}
	                </div>  

	                <div class="form-group">
	                    {{ Form::submit('Cadastrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
	                </div>

	            </div>


	        {{ Form::close() }}
	       </div>
		</div>
	</div>

@endsection()