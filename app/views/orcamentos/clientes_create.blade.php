@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">

    				{{ Form::open(array('route'=> 'orcamentos.store', 'class'=>'form')) }}

    					@if( $dadosCliente->nome_fantasia_cliente != '')

		    				<h3 class="page-header">Cadastrar orçamento para {{ $dadosCliente->nome_fantasia_cliente }}</h3>

		    			@else

		    				<h3 class="page-header">Cadastrar orçamento para {{ $dadosCliente->nome_completo }}</h3>

		    			@endif

		    			<hr>

		    			<div class="row well">

		    				<div class="form-group">

		    					{{ Form::hidden('id_usuario', $dadosVendedor->id_user, array('id' => 'id_usuario')) }}
		    					{{ Form::hidden('id_cliente_indicado', $dadosCliente->id_cliente_sistema_eficaz, array('id' => 'id_cliente_indicado')) }}

		    					 <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('titulo_orcamento', 'Título do orçamento') }}
			                    {{ Form::text('titulo_orcamento', null, array( 'id'=>'titulo_orcamento', 'class'=>'form-control', 'placeholder'=>'Título do orçamento.')) }}
			                    {{ $errors->first('titulo_orcamento', '<span class=inputError>:message</span>') }}

		    				</div>

		    				<div class="form-group">

		    					{{ Form::Label('descricao_orcamento', 'Descrição') }}
			                    {{ Form::textarea('descricao_orcamento', null, array( 'id'=>'descricao_orcamento', 'class'=>'form-control', 'placeholder'=>'Breve descrição do orçamento.')) }}
			                    {{ $errors->first('descricao_orcamento', '<span class=inputError>:message</span>') }}

		    				</div>

		    				<div class="form-group">
			                    {{ Form::submit('Cadastrar orçamento', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                </div>

			                <div>
			                	<a href="{{ URL::to('/orcamentos/'.$dadosCliente->id_cliente_indicado) }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
			                </div>

		    			</div>

    				{{ Form::close() }}

    			</div>

    		</div>

    	</div>
    </section>

@endsection()