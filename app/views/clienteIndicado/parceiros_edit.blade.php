@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="row">
				<div class="col-md-6 col-md-offset-3">

					{{ Form::open(array('route'=> 'indicacoes.update', 'class'=>'form','files' => true, 'method' => 'PUT')) }}

						<h3 class="page-header">Edição indicação para {{ $dadosVendedor->nome_vendedor }}</h3>
	          			
	          			<hr>

	          			<div class="row well">

	          				<div class="form-group">
			            		{{ Form::hidden('id_indicacao', $cliente['Cadastro_ID'], array('id' => 'id_indicacao')) }}

			            		{{ Form::hidden('id_cliente_sistema_eficaz', $cliente['Cadastro_ID'], array('id' => 'id_cliente_sistema_eficaz')) }}	

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('nome_completo', 'Nome completo') }} *Obrigatório
			                    {{ Form::text('nome_completo', $cliente['Nome'], array( 'id'=>'nome_completo', 'class'=>'form-control', 'placeholder'=>'Nome completo')) }}
			                    {{ $errors->first('nome_completo', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('nome_fantasia', 'Nome fantasia') }}
			                    {{ Form::text('nome_fantasia', $cliente['Nome_Fantasia'], array( 'id'=>'nome_fantasia', 'class'=>'form-control', 'placeholder'=>'Nome completo')) }}
			                    {{ $errors->first('nome_fantasia', '<span class=inputError>:message</span>') }}
			                </div>


			                <div class="form-group">

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('email_cliente', 'Email cliente') }} *Obrigatório
			                    {{ Form::text('email_cliente', $cliente['Email'], array( 'id'=>'email_cliente', 'class'=>'form-control', 'placeholder'=>'Email cliente')) }}
			                    {{ $errors->first('email_cliente', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('data_nascimento_criacao', 'Data nascimento/criação') }}
			                    {{ Form::text('data_nascimento_criacao', $data_nascimento_criacao, array( 'id'=>'data_nascimento_criacao', 'class'=>'form-control', 'placeholder'=>'Data de nascimento ou criação')) }}
			                    {{ $errors->first('data_nascimento_criacao', '<span class=inputError>:message</span>') }}
			                </div>


			                <div class="form-group">

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('cpf_cnpj', 'Cpf ou Cnpj') }}
			                    {{ Form::text('cpf_cnpj', $cliente['Cpf_Cnpj'], array( 'id'=>'cpf_cnpj', 'class'=>'form-control', 'placeholder'=>'Cpf ou Cnpj')) }}
			                    {{ $errors->first('cpf_cnpj', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">

			                	@if($cliente['Foto'] != '')

			                		<img src="{{ URL::asset('img/uploads/imagens_documentos').'/'.$cliente->cliente_imagem_documento }}">

			                	@endif

			                	{{ Form::hidden('imagem_antiga', $cliente['Foto'], array('id' => 'imagem_antiga')) }}

			                </div>

			                <div class="form-group">

			                	{{ Form::Label('imagem_documento', 'Tirar foto de documento') }}
			                	{{ Form::label('imagem_documento', 'Imagem documento',array('class' => 'sr-only' )) }}
					    		{{ Form::file('imagem_documento', array('accept'=> 'image/*;capture=camera')) }}

			                </div>

			                <div class="form-group">
			                    {{ Form::submit('Atualizar', array('class'=>'btn btn-large btn-primary btn-block'))}}
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