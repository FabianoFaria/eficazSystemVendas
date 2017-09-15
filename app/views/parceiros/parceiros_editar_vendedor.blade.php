@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
      	<div class="container">

      		<div class="row">

        		<div class="col-lg-6 col-lg-offset-3">


        			<div class="panel panel-default">

        				<div class="panel-heading">
			                <h3 class="text-center">Verifique seus dados para atualizar.</h3>  
			            </div>
			            <div class="panel-body">

			            	{{ Form::open(['route'=>'vendedores.update', 'class'=>'form-signin', 'method'=>'PUT']) }}

			            		{{ Form::hidden('id_usuario', Session::get('id_atual'), array('id' => 'id_usuario')) }}
			            		{{ Form::hidden('id_vendedor', $vendedor->id_vendedor, array('id' => 'id_vendedor')) }}

			            		<div class="form-group">
			                        <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                        {{ Form::Label('nomeCompleto', 'Nome do completo') }}
			                        {{ Form::text('nomeCompleto', $vendedor->nome_vendedor, array( 'id'=>'nomeCompleto', 'class'=>'form-control', 'placeholder'=>'Nome completo')) }}
			                        {{ $errors->first('nomeCompleto', '<span class=inputError>:message</span>') }}
			                    </div>

			                    <div class="form-group">
			                        <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                        {{ Form::Label('nomeFantasia', 'Nome fantasia') }}
			                        {{ Form::text('nomeFantasia', $vendedor->nome_fantasia, array( 'id'=>'nomeFantasia', 'class'=>'form-control', 'placeholder'=>'Nome fantasia')) }}
			                        {{ $errors->first('nomeFantasia', '<span class=inputError>:message</span>') }}
			                    </div>

			                    <div class="form-group">
			                        <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                        {{ Form::Label('rgVendedor', 'R.G vendedor') }}
			                        {{ Form::text('rgVendedor', $vendedor->rg_vendedor, array( 'id'=>'rgVendedor', 'class'=>'form-control', 'placeholder'=>'R.G')) }}
			                        {{ $errors->first('rgVendedor', '<span class=inputError>:message</span>') }}
			                    </div>

			                    <div class="form-group">
			                        <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                        {{ Form::Label('cpfCnpj', 'CPF/CNPJ') }}
			                        {{ Form::text('cpfCnpj', $vendedor->cnpj_cpf, array( 'id'=>'cpfCnpj', 'class'=>'form-control', 'placeholder'=>'CPF ou CNPJ')) }}
			                        {{ $errors->first('cpfCnpj', '<span class=inputError>:message</span>') }}
			                    </div>

			                    <div class="form-group">
			                        <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                        {{ Form::Label('generoVendedor', 'Gênero') }}
			                                    
			                        {{ 
			                        	Form::radio('generoVendedor', '0', array('class'=>'form-control')) 
			                        }} Feminino

			                        {{ 
			                        	Form::radio('generoVendedor', '1', array('class'=>'form-control')) 
			                        }} Masculino

			                    </div>

			                    <div class="form-group">
			                   	 	{{ Form::submit('Atualizar', array('class'=>'btn btn-large btn-primary btn-block'))}}
			                    </div>

			                    <div class="form-group">
				                	<a href="{{ URL::to('/users/' . Session::get('id_atual')) }}" class="btn btn-large btn-danger btn-block"> Cancelar</a>
				                </div>

			            	{{ Form::close() }}

			            </div>
        			</div>

        		</div>

        	</div>

      	</div>
    </section>

@endsection()