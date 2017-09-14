@extends('layouts.main_site')

@section('content')

	
	<section class="features" id="features">
      <div class="container">
        <div class="section-heading text-center">
          <h2>Bem vindo(a) : {{ Session::get('nome_atual') }} </h2>
          <p class="text-muted">Verifique a situação de sua parceira.</p>
          <hr>
        </div>

        <!-- EFETUA A VERIFICAÇÃO DE CADASTROS -->
        @if( ! empty($dadosVendedor))

        	<div class="row">

        		<div class="col-lg-12 my-auto">

        			<div class="container-fluid">

        				@if(empty($enderecos))
			                <div class="row">
			                    <div class="alert alert-danger">
			                        <h4 class="text-center">Nenhum endereço cadastrado.</h4>
			                        <a href="{{ url('/enderecos'); }} ">
			                            <h5 class="text-center"><i class="fa fa-list-alt "></i> Adicionar endereço.</h5>
			                        </a>
			                    </div>
			                </div>
			            @endif

			            @if(empty($telefones))
			                <div class="row">
			                    <div class="alert alert-danger">
			                    <h4 class="text-center">Nenhum telefone cadastrado.</h4>
			                        <a href="{{ url('/telefones'); }} ">
			                            <h5 class="text-center"><i class="fa fa-phone "></i> Adicionar telefone.</h5>
			                        </a>
			                    </div>
			                </div>
			            @endif
        				
        				<div class="row">




        				</div>

        			</div>

        		</div>

        	</div>

        @else

        	<div class="row">

        		<div class="col-lg-12 my-auto">

        			<div class="container-fluid">

        				<div class="row">

        					<div class="col-lg-6 col-lg-offset-3">


        						<div class="panel panel-default">

        							<div class="panel-heading">
			                            <h3 class="text-center">Por favor complete seu cadastro.</h3>  
			                        </div>

			                        <div class="panel-body">

			                        	{{ Form::open(['route'=>'vendedores.store', 'class'=>'form-signin']) }}

			                        		{{ Form::hidden('id_usuario', Session::get('id_atual'), array('id' => 'id_usuario')) }}

			                        		<div class="form-group">
			                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                                    {{ Form::Label('nomeCompleto', 'Nome do completo') }}
			                                    {{ Form::text('nomeCompleto', null, array( 'id'=>'nomeCompleto', 'class'=>'form-control', 'placeholder'=>'Nome completo')) }}
			                                    {{ $errors->first('nomeCompleto', '<span class=inputError>:message</span>') }}
			                                </div>

			                                <div class="form-group">
			                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                                    {{ Form::Label('nomeFantasia', 'Nome fantasia') }}
			                                    {{ Form::text('nomeFantasia', null, array( 'id'=>'nomeFantasia', 'class'=>'form-control', 'placeholder'=>'Nome fantasia')) }}
			                                    {{ $errors->first('nomeFantasia', '<span class=inputError>:message</span>') }}
			                                </div>

			                                <div class="form-group">
			                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                                    {{ Form::Label('rgVendedor', 'R.G vendedor') }}
			                                    {{ Form::text('rgVendedor', null, array( 'id'=>'rgVendedor', 'class'=>'form-control', 'placeholder'=>'R.G')) }}
			                                    {{ $errors->first('rgVendedor', '<span class=inputError>:message</span>') }}
			                                </div>

			                                <div class="form-group">
			                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                                    {{ Form::Label('cpfCnpj', 'CPF/CNPJ') }}
			                                    {{ Form::text('cpfCnpj', null, array( 'id'=>'cpfCnpj', 'class'=>'form-control', 'placeholder'=>'CPF ou CNPJ')) }}
			                                    {{ $errors->first('cpfCnpj', '<span class=inputError>:message</span>') }}
			                                </div>

			                                <div class="form-group">
			                                    <!-- <label for="nomeCliente">Nome do usuário</label> -->
			                                    {{ Form::Label('generoVendedor', 'Gênero') }}
			                                    
			                                    {{ Form::radio('generoVendedor', '0', array('class'=>'form-control')) }} Feminino
			                                    {{ Form::radio('generoVendedor', '1', array('class'=>'form-control')) }} Masculino

			                                </div>

			                                 {{ Form::submit('Registrar', array('class'=>'btn btn-large btn-primary btn-block'))}}

			                        	{{ Form::close() }}
        								
        							</div>

        						</div>

        					</div>

        				</div>

        			</div>

        		</div>

        	</div>

        @endif


      </div>
    </section>
	

@endsection()