@extends('layouts.main_site')

@section('content')


	<section class="features" id="features">
    	<div class="container">

    		<div class="row">
				<div class="col-md-6 col-md-offset-3">


					{{ Form::open(array('route'=> 'enderecos_indicacoes.update', 'class'=>'form', 'method'=>'PUT')) }}

	            		@if( $dadosCliente['Nome_Fantasia'] != '')

		    				<h3 class="page-header">Editando endereço para {{ $dadosCliente['Nome_Fantasia'] }}</h3>

		    			@else

		    				<h3 class="page-header">Editando endereço para {{ $dadosCliente['Nome'] }}</h3>

		    			@endif

		    			<hr>

	            		<div class="row well">

	            			<div class="form-group">
			            		{{ Form::hidden('id_cliente', $enderecos['Cadastro_ID'], array('id' => 'id_cliente')) }}

			            		{{ Form::hidden('id_endereco_sistema', $enderecos['Cadastro_Endereco_ID'], array('id' => 'id_endereco_sistema')) }}		


			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('logradouro', 'Logradouro') }}
			                    {{ Form::text('logradouro', $enderecos['Logradouro'], array( 'id'=>'logradouro', 'class'=>'form-control', 'placeholder'=>'Rua, Av ou estrada')) }}
			                    {{ $errors->first('logradouro', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('numero', 'Número') }}
			                    {{ Form::text('numero', $enderecos['Numero'], array( 'id'=>'numero', 'class'=>'form-control', 'placeholder'=>'Número')) }}
			                    {{ $errors->first('numero', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('complemento', 'Complemento') }}
			                    {{ Form::text('complemento', $enderecos['Complemento'], array( 'id'=>'complemento', 'class'=>'form-control', 'placeholder'=>'Complemento')) }}
			                    {{ $errors->first('complemento', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('bairro', 'Bairro') }}
			                    {{ Form::text('bairro', $enderecos['Bairro'], array( 'id'=>'bairro', 'class'=>'form-control', 'placeholder'=>'Bairro')) }}
			                    {{ $errors->first('bairro', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('cidade', 'Cidade') }}
			                    {{ Form::text('cidade', $enderecos['Cidade'], array( 'id'=>'cidade', 'class'=>'form-control', 'placeholder'=>'Cidade')) }}
			                    {{ $errors->first('cidade', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <label></label>
			                    {{ Form::Label('estado_endereco', 'Estado') }}
			                    <select class="form-control" name="estado_endereco" id="estado_endereco">

			                        @foreach($estados->all() as $estado)

			                        	@if($enderecos['UF'] == $estado->sigla_estado)

			                        		<option value="{{$estado->id_estado}}" selected>{{$estado->nome_estado}}</option>

			                        	@else

			                        		<option value="{{$estado->id_estado}}">{{$estado->nome_estado}}</option>

			                        	@endif
			        
			                        @endforeach
			                    </select>
			                    {{ $errors->first('estado_endereco', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('cep', 'CEP') }}
			                    {{ Form::text('cep', $enderecos['CEP'], array( 'id'=>'cep', 'class'=>'form-control', 'placeholder'=>'CEP')) }}
			                    {{ $errors->first('cep', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    {{ Form::submit('Concluir edição', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                </div>
			                 <div>
			                	<a href="{{ URL::to('/enderecos_indicacoes/'.$enderecos['Cadastro_ID'] ) }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
			                </div>

	            		</div>

	            	{{ Form::close() }}

				</div>
			</div>

    	</div>
    </section>


@endsection()