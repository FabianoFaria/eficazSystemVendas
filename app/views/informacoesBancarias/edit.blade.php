
@extends('layouts.main')

@section('content')

	<div id="page-wrapper">

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			
			{{ Form::open(array('route'=> 'financas.update', 'class'=>'form', 'method'=>'PUT')) }}
	            <h3 class="form-signup-heading">Edição de conta bancária.</h3>

	            <div class="row well">


	            	<div class="form-group">
	            		{{ Form::hidden('id_conta_vendedor', $contas->id_conta_vendedor, array('id' => 'id_conta_vendedor')) }}
	            		
	            		{{ Form::hidden('id_usuario', $dadosVendedor->id_user, array('id' => 'id_usuario')) }}	

	                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
	                    {{ Form::Label('nomeConta', 'Nome da conta') }}
	                    {{ Form::text('nomeConta', $contas->nome_conta, array( 'id'=>'nomeConta', 'class'=>'form-control', 'placeholder'=>'Nome para a conta')) }}
	                    {{ $errors->first('nomeConta', '<span class=inputError>:message</span>') }}
	                </div>

	                <div class="form-group">
	                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
	                    {{ Form::Label('numeroConta', 'Número da conta') }}
	                    {{ Form::text('numeroConta', $contas->numero_conta, array( 'id'=>'numeroConta', 'class'=>'form-control', 'placeholder'=>'Número da conta')) }}
	                    {{ $errors->first('numeroConta', '<span class=inputError>:message</span>') }}
	                </div>

	                <div class="form-group">
	                    <label></label>
	                    {{ Form::Label('tipoConta', 'Tipo da conta') }}
	                    <select class="form-control" name="tipoConta" id="tipoConta">

	                        @foreach($tipo_contas->all() as $tipoConta)

	                        	@if($contas->tipo_conta == $tipoConta->id_tipo_conta)
	                        		<option value="{{$tipoConta->id_tipo_conta}}" selected >{{$tipoConta->tipo_conta}}</option>
	                        	@else
	                        		<option value="{{$tipoConta->id_tipo_conta}}">{{$tipoConta->tipo_conta}}</option>
	                        	@endif

	                        @endforeach
	                    </select>
	                    {{ $errors->first('tipoConta', '<span class=inputError>:message</span>') }}
	                </div>

	                 <div class="form-group">
	                    <label></label>
	                    {{ Form::Label('instituicao', 'Nome do banco') }}
	                    <select class="form-control" name="instituicao" id="instituicao">

	                        @foreach($lista_bancos->all() as $bancos)

	                        	@if($contas->instituicao == $bancos->id_tipo_conta)
	                        		<option value="{{$bancos->id_instituicao_bancaria}}" selected >{{ $bancos->nome_instituicao_bancaria }}</option>
	                        	@else
	                        		<option value="{{$bancos->id_instituicao_bancaria}}">{{ $bancos->nome_instituicao_bancaria }}</option>

	                        	@endif
	        
	                        @endforeach
	                    </select>
	                    {{ $errors->first('instituicao', '<span class=inputError>:message</span>') }}
	                </div>

	                <div class="form-group">
	                    {{ Form::submit('Cadastrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
	                </div>

	            </div>


	        {{ Form::close() }}
	       </div>
		</div>
	</div>

@endsection()