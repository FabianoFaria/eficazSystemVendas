@extends('layouts.main_site')

@section('content')


	<section class="features" id="features">
    	<div class="container">

    		<div class="row">
				<div class="col-md-6 col-md-offset-3">


					{{ Form::open(array('route'=> 'enderecos.update', 'class'=>'form', 'method'=>'PUT')) }}
	            		<h3 class="form-signup-heading">Edição de endereço de usuário {{ $dadosVendedor->nome_vendedor }}.</h3>

	            		<div class="row well">

	            			<div class="form-group">
			            		{{ Form::hidden('id_endereco', $enderecos->id_endereco, array('id' => 'id_endereco')) }}	

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('logradouro', 'Logradouro') }}
			                    {{ Form::text('logradouro', $enderecos->logradouro, array( 'id'=>'logradouro', 'class'=>'form-control', 'placeholder'=>'Rua, Av ou estrada')) }}
			                    {{ $errors->first('logradouro', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('numero', 'Número') }}
			                    {{ Form::text('numero', $enderecos->numero, array( 'id'=>'numero', 'class'=>'form-control', 'placeholder'=>'Número')) }}
			                    {{ $errors->first('numero', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('complemento', 'Complemento') }}
			                    {{ Form::text('complemento', $enderecos->complemento, array( 'id'=>'complemento', 'class'=>'form-control', 'placeholder'=>'Complemento')) }}
			                    {{ $errors->first('complemento', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('bairro', 'Bairro') }}
			                    {{ Form::text('bairro', $enderecos->bairro, array( 'id'=>'bairro', 'class'=>'form-control', 'placeholder'=>'Bairro')) }}
			                    {{ $errors->first('bairro', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('cidade', 'Cidade') }}
			                    {{ Form::text('cidade', $enderecos->cidade, array( 'id'=>'cidade', 'class'=>'form-control', 'placeholder'=>'Cidade')) }}
			                    {{ $errors->first('cidade', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <label></label>
			                    {{ Form::Label('estado_endereco', 'Estado') }}
			                    <select class="form-control" name="estado_endereco" id="estado_endereco">

			                        @foreach($estados->all() as $estado)

			                        	@if($enderecos->uf == $estado->id_estado)

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
			                    {{ Form::text('cep', $enderecos->cep_endereco, array( 'id'=>'cep', 'class'=>'form-control', 'placeholder'=>'CEP')) }}
			                    {{ $errors->first('cep', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    {{ Form::submit('Concluir edição', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                </div>
			                 <div>
			                	<a href="{{ URL::to('/enderecos') }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
			                </div>

	            		</div>

	            	{{ Form::close() }}

				</div>
			</div>

    	</div>
    </section>


@endsection()