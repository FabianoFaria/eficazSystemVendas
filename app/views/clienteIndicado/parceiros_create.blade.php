@extends('layouts.main_site')

@section('content')
	
	<section class="features" id="features">
    	<div class="container">

    		<div class="row">
				<div class="col-md-6 col-md-offset-3">


					{{ Form::open(array('route'=> 'indicacoes.store', 'class'=>'form')) }}


						<h3 class="page-header">Cadastrando nova indicação para {{ $dadosVendedor->nome_vendedor }}</h3>
	          			
	          			<hr>

	          			<div class="row well">


	          				<div class="form-group">
			            		{{ Form::hidden('id_usuario', $dadosVendedor->id_user, array('id' => 'id_usuario')) }}	

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('nome_completo', 'Nome completo') }}
			                    {{ Form::text('nome_completo', null, array( 'id'=>'nome_completo', 'class'=>'form-control', 'placeholder'=>'Nome completo')) }}
			                    {{ $errors->first('nome_completo', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('nome_fantasia', 'Nome fantasia') }}
			                    {{ Form::text('nome_fantasia', null, array( 'id'=>'nome_fantasia', 'class'=>'form-control', 'placeholder'=>'Nome completo')) }}
			                    {{ $errors->first('nome_fantasia', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('data_nascimento_criacao', 'Data nascimento/criação') }}
			                    {{ Form::text('data_nascimento_criacao', null, array( 'id'=>'data_nascimento_criacao', 'class'=>'form-control', 'placeholder'=>'Data de nascimento ou criação')) }}
			                    {{ $errors->first('data_nascimento_criacao', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('cpf_cnpj', 'Cpf ou Cnpj') }}
			                    {{ Form::text('cpf_cnpj', null, array( 'id'=>'cpf_cnpj', 'class'=>'form-control', 'placeholder'=>'Cpf ou Cnpj')) }}
			                    {{ $errors->first('cpf_cnpj', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    {{ Form::submit('Cadastrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                </div>
			                <div>
			                	<a href="{{ URL::to('/indicacoes') }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
			                </div>

	          			</div>

					{{ Form::close() }}


				</div>
			</div>

    	</div>

    </section>


@endsection()