@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">

    				{{ Form::open(array('route'=> 'telefones_indicacoes.update', 'class'=>'form', 'method'=>'PUT')) }}


    					@if( $dadosCliente['Nome_Fantasia'] != '')

		    				<h3 class="page-header">Editar telefone para {{ $dadosCliente['Nome_Fantasia'] }}</h3>

		    			@else

		    				<h3 class="page-header">Editar telefone para {{ $dadosCliente['Nome'] }}</h3>

		    			@endif


		    			<div class="row well">


		    				<div class="form-group">
			            		{{ Form::hidden('id_cliente', $dadosCliente['Cadastro_ID'], array('id' => 'id_cliente')) }}

			            		{{ Form::hidden('id_sistema_eficaz', $telefones['Cadastro_Telefone_ID'], array('id' => 'id_sistema_eficaz')) }}

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('telefone', 'Logradouro') }} *Obrigatório, somente números sem espaço.
			                    {{ Form::text('telefone', $telefones['Telefone'], array( 'id'=>'telefone', 'class'=>'form-control', 'placeholder'=>'Número do telefone')) }}
			                    {{ $errors->first('telefone', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('observacao', 'Observação') }}
			                    {{ Form::textarea('observacao', $telefones['Observacao'], array( 'id'=>'observacao', 'class'=>'form-control', 'placeholder'=>'Observação')) }}
			                    {{ $errors->first('observacao', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    {{ Form::submit('Concluir edição', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                </div>

			                <div>
			                	<a href="{{ URL::to('/telefones_indicacoes/'. $dadosCliente['Cadastro_ID']) }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
			                </div>

		    			</div>

    				{{ Form::close() }}

    			</div>

    		</div>

    	</div>
    </section>

@endsection()