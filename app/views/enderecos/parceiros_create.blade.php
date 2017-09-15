@extends('layouts.main_site')

@section('content')


	<section class="features" id="features">
    	<div class="container">

	        <div class="row">
				<div class="col-md-6 col-md-offset-3">

					{{ Form::open(array('route'=> 'enderecos.store', 'class'=>'form')) }}

						<h3 class="page-header">Cadastrando novo endereço para {{ $dadosVendedor->nome_vendedor }}</h3>
	          			
	          			<hr>

						<div class="row well">

							<div class="form-group">
			            		{{ Form::hidden('id_usuario', $dadosVendedor->id_user, array('id' => 'id_usuario')) }}	

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('logradouro', 'Logradouro') }}
			                    {{ Form::text('logradouro', null, array( 'id'=>'logradouro', 'class'=>'form-control', 'placeholder'=>'Rua, Av ou estrada')) }}
			                    {{ $errors->first('logradouro', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('numero', 'Número') }}
			                    {{ Form::text('numero', null, array( 'id'=>'numero', 'class'=>'form-control', 'placeholder'=>'Número')) }}
			                    {{ $errors->first('numero', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('complemento', 'Complemento') }}
			                    {{ Form::text('complemento', null, array( 'id'=>'complemento', 'class'=>'form-control', 'placeholder'=>'Complemento')) }}
			                    {{ $errors->first('complemento', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('bairro', 'Bairro') }}
			                    {{ Form::text('bairro', null, array( 'id'=>'bairro', 'class'=>'form-control', 'placeholder'=>'Bairro')) }}
			                    {{ $errors->first('bairro', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('cidade', 'Cidade') }}
			                    {{ Form::text('cidade', null, array( 'id'=>'cidade', 'class'=>'form-control', 'placeholder'=>'Cidade')) }}
			                    {{ $errors->first('cidade', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <label></label>
			                    {{ Form::Label('estado_endereco', 'Estado') }}
			                    <select class="form-control" name="estado_endereco" id="estado_endereco">

			                    	<option value=" ">Selecione... </option>

			                        @foreach($estados->all() as $estado)

			                            <option value="{{$estado->id_estado}}">{{$estado->nome_estado}}</option>
			        
			                        @endforeach
			                    </select>
			                    {{ $errors->first('estado_endereco', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('cep', 'CEP') }}
			                    {{ Form::text('cep', null, array( 'id'=>'cep', 'class'=>'form-control', 'placeholder'=>'CEP')) }}
			                    {{ $errors->first('cep', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    {{ Form::submit('Cadastrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
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