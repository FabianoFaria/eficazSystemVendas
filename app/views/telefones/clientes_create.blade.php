@extends('layouts.main_site')

@section('content')
	
	<section class="features" id="features">
    	<div class="container">

    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">

    				{{ Form::open(array('route'=> 'telefones_indicacoes.store', 'class'=>'form')) }}

    					@if( $dadosCliente['Nome_Fantasia'] != '')

		    				<h3 class="page-header">Cadastrar telefone para {{ $dadosCliente['Nome_Fantasia'] }}</h3>

		    			@else

		    				<h3 class="page-header">Cadastrar telefone para {{ $dadosCliente['Nome_Fantasia'] }}</h3>

		    			@endif

			          	<hr>

			          	<div class="row well">

			          		<div class="form-group">
			            		{{ Form::hidden('id_usuario', $dadosVendedor->id_user, array('id' => 'id_usuario')) }}	

			            		{{ Form::hidden('id_cliente_indicado', $dadosCliente['Cadastro_ID'], array('id' => 'id_cliente_indicado')) }}

			            		{{ Form::hidden('id_sistema_eficaz', $dadosCliente['Cadastro_ID'], array('id' => 'id_sistema_eficaz')) }}

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('telefone', 'Telefone') }} *Obrigatório, somentes números sem espaço
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

			                <div>
			                	<a href="{{ URL::to('/telefones_indicacoes/'.$dadosCliente['Cadastro_ID']) }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
			                </div>

			          	</div>

    				{{ Form::close() }}

    			</div>

    		</div>

    	</div>
    </section>

@endsection()