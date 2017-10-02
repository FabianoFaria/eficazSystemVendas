@extends('layouts.main_site')

@section('content')
	
	<section class="features" id="features">
    	<div class="container">

    		<div class="row">

    			<div class="col-md-6 col-md-offset-3">
	    			{{ Form::open(array('route'=> 'financas.store', 'class'=>'form')) }}
		            	<h3 class="page-header">Cadastrando novo endereço para {{ $dadosVendedor->nome_vendedor }}</h3>
		          			
		          		<hr>

		          		<div class="row well">


		          			<div class="form-group">
			            		{{ Form::hidden('id_usuario', $dadosVendedor->id_user, array('id' => 'id_usuario')) }}	

			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('nomeConta', 'Nome da conta') }} *Obrigatório
			                    {{ Form::text('nomeConta', null, array( 'id'=>'nomeConta', 'class'=>'form-control', 'placeholder'=>'Nome para a conta')) }}
			                    {{ $errors->first('nomeConta', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('agencia', 'Agência') }} *Obrigatório
			                    {{ Form::text('agencia', null, array( 'id'=>'agencia', 'class'=>'form-control', 'placeholder'=>'Número da agência')) }}
			                    {{ $errors->first('agencia', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                    {{ Form::Label('numeroConta', 'Número da conta') }} *Obrigatório
			                    {{ Form::text('numeroConta', null, array( 'id'=>'numeroConta', 'class'=>'form-control', 'placeholder'=>'Número da conta')) }}
			                    {{ $errors->first('numeroConta', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <label></label>
			                    {{ Form::Label('tipoConta', 'Tipo da conta') }} *Obrigatório
			                    <select class="form-control" name="tipoConta" id="tipoConta">

			                    	<option value=" ">Selecione... </option>

			                        @foreach($tipo_contas->all() as $tipoConta)

			                            <option value="{{$tipoConta->id_tipo_conta}}">{{$tipoConta->tipo_conta}}</option>
			        
			                        @endforeach
			                    </select>
			                    {{ $errors->first('tipoConta', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    <label></label>
			                    {{ Form::Label('instituicao', 'Nome do banco') }} *Obrigatório
			                    <select class="form-control" name="instituicao" id="instituicao">

			                    	<option value=" ">Selecione... </option>

			                        @foreach($lista_bancos->all() as $bancos)

			                            <option value="{{$bancos->id_instituicao_bancaria}}">{{ $bancos->nome_instituicao_bancaria }}</option>
			        
			                        @endforeach
			                    </select>
			                    {{ $errors->first('instituicao', '<span class=inputError>:message</span>') }}
			                </div>

			                <div class="form-group">
			                    {{ Form::submit('Cadastrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                </div>
			                <div class="form-group">

						        <a href="{{ URL::to('/financas') }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
						        
			                </div>
			                
		          		</div>

		            {{ Form::close() }}
		        </div>

    		</div>

    	</div>	
    </section>

@endsection()