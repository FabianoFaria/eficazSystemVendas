@extends('layouts.main_site')

@section('content')

	<!-- Page Content -->
    <div class="container">

    	<!-- Jumbotron Header -->
	    <header class="jumbotron my-4">
	        <h2>Bem vindo(a) : {{ Session::get('nome_atual') }} </h2>
	        <p class="text-muted">
	        	A Eficaz System lhe dá as boas vindas ao sistema, comece agora a efetuar suas indicações.
	        </p>
	      <!--   <hr> -->
	        <a href="{{ url('/indicacoes'); }}" class="btn btn-success btn-lg">Indicar um cliente!</a>
	    </header>

    </div>

	<section class="features section_index" id="features">

	    <div class="container">
	     
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

				            @if(empty($financeiro))
				                <div class="row">
				                    <div class="alert alert-danger">
				                    <h4 class="text-center">Nenhuma conta cadastrada.</h4>
				                        <a href="{{ url('/financas'); }} ">
				                            <h5 class="text-center"><i class="fa fa-phone "></i> Adicionar conta bancaria.</h5>
				                        </a>
				                    </div>
				                </div>
				            @endif
	        				
	        				<!-- Com os dados todos completos, segue a disposição normal da tela -->
	        				<div class="row text-center">

	        					<div class="col-lg-3 col-md-6">
						          	<div class="card">
						            	<!-- <img class="card-img-top" src="http://placehold.it/500x325" alt=""> -->
						            	<div class="feature-item card-img-top">
						            		<i class="icon-people text-primary"></i>
						            	</div>

						            	<div class="card-body">
						              		<h4 class="card-title">Indicações</h4>
						             		<p class="card-text">Cadastre e gerencie as informações de suas indicações.</p>
						            	</div>
						            	<div class="card-footer">
						              		<a href="{{ url('/indicacoes'); }}" class="btn btn-success">Gerenciar</a>
						           		</div>
							        </div>
							    </div>

							    <div class="col-lg-3 col-md-6">
						          	<div class="card">
						            	<!-- <img class="card-img-top" src="http://placehold.it/500x325" alt=""> -->
						            	<div class="feature-item card-img-top">
						            		<i class="icon-wallet text-primary"></i>
						            	</div>
						            	<div class="card-body">
						              		<h4 class="card-title">Orçamentos</h4>
						             		<p class="card-text">Acompanhe como está a situação dos orçamentos que você indicou.</p>
						            	</div>
						            	<div class="card-footer">
						              		<a href="{{ url('/orcamentos'); }}" class="btn btn-success">Gerenciar</a>
						           		</div>
							        </div>
							    </div>

							    <!-- <div class="col-lg-3 col-md-6">
						          	<div class="card"> -->
						            	<!-- <img class="card-img-top" src="http://placehold.it/500x325" alt=""> -->
						            	<!-- <div class="feature-item card-img-top">
						            		<i class="icon-credit-card text-primary"></i>
						            	</div>
						            	<div class="card-body">
						              		<h4 class="card-title">Comissões</h4>
						             		<p class="card-text">Verifique o quanto suas indicações para a Eficaz estão rendendo.</p>
						            	</div>
						            	<div class="card-footer">
						              		<a href="{{ url('/indicacoes'); }}" class="btn btn-success">Gerenciar</a>
						           		</div>
							        </div>
							    </div> -->

							    <div class="col-lg-3 col-md-6">
						          	<div class="card">
						            	<!-- <img class="card-img-top" src="http://placehold.it/500x325" alt=""> -->
						            	<div class="feature-item card-img-top">
						            		<i class="icon-info text-primary"></i>
						            	</div>
						            	<div class="card-body">
						              		<h4 class="card-title">Seus dados</h4>
						             		<p class="card-text">Confira seus dados cadastrados em nosso sistema.</p>
						            	</div>
						            	<div class="card-footer">
						              		<a href="{{ URL::to('/users/' . Session::get('id_atual')) }}" class="btn btn-success">Gerenciar</a>
						           		</div>
							        </div>
							    </div>

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

    <hr>

	<section class="features section_index" id="">
		
	</section>

@endsection()