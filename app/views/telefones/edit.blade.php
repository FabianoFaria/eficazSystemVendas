
@extends('layouts.main')

@section('content')

	<div id="page-wrapper">

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			
			{{ Form::open(array('route'=> 'telefones.update', 'class'=>'form', 'method'=>'PUT')) }}
	            <h3 class="form-signup-heading">Edição de telefone de usuário.</h3>

	            <div class="row well">


	            	<div class="form-group">
	            		{{ Form::hidden('id_telefone', $telefones->id_telefone, array('id' => 'id_telefone')) }}	
	                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
	                    {{ Form::Label('telefone', 'Logradouro') }}
	                    {{ Form::text('telefone', $telefones->telefone, array( 'id'=>'telefone', 'class'=>'form-control', 'placeholder'=>'Número do telefone')) }}
	                    {{ $errors->first('telefone', '<span class=inputError>:message</span>') }}
	                </div>

	                <div class="form-group">
	                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
	                    {{ Form::Label('observacao', 'Observação') }}
	                    {{ Form::textarea('observacao', $telefones->observacacao_telefone, array( 'id'=>'observacao', 'class'=>'form-control', 'placeholder'=>'Observação')) }}
	                    {{ $errors->first('observacao', '<span class=inputError>:message</span>') }}
	                </div>

	                <div class="form-group">
	                    {{ Form::submit('Concluir edição', array('class'=>'btn btn-large btn-primary btn-block'))}}
	                </div>

	            </div>


	        {{ Form::close() }}
	       </div>
		</div>
	</div>

@endsection()