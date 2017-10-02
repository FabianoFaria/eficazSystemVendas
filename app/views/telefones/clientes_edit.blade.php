@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">

    				{{ Form::open(array('route'=> 'telefones_indicacoes.update', 'class'=>'form', 'method'=>'PUT')) }}


    					@if( $dadosCliente->nome_fantasia_cliente != '')

		    				<h3 class="page-header">Editar telefone para {{ $dadosCliente->nome_fantasia_cliente }}</h3>

		    			@else

		    				<h3 class="page-header">Editar telefone para {{ $dadosCliente->nome_completo }}</h3>

		    			@endif


		    			<div class="row well">


		    				<div class="form-group">
			            		{{ Form::hidden('id_telefone', $telefones->id_cliente_telefone, array('id' => 'id_telefone')) }}

			            		{{ Form::hidden('id_sistema_eficaz', $telefones->id_telefone_sistema_eficaz, array('id' => 'id_sistema_eficaz')) }}

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('telefone', 'Logradouro') }} *Obrigatório
			                    {{ Form::text('telefone', $telefones->telefone_cliente, array( 'id'=>'telefone', 'class'=>'form-control', 'placeholder'=>'Número do telefone')) }}
			                    {{ $errors->first('telefone', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('observacao', 'Observação') }}
			                    {{ Form::textarea('observacao', $telefones->observacao_telefone, array( 'id'=>'observacao', 'class'=>'form-control', 'placeholder'=>'Observação')) }}
			                    {{ $errors->first('observacao', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    {{ Form::submit('Concluir edição', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                </div>

			                <div>
			                	<a href="{{ URL::to('/telefones_indicacoes/'.$dadosCliente->id_cliente_indicado) }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
			                </div>

		    			</div>

    				{{ Form::close() }}

    			</div>

    		</div>

    	</div>
    </section>

@endsection()