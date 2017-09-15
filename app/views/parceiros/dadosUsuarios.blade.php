@extends('layouts.main_site')

@section('content')

	<section class="features" id="features">
    	<div class="container">

    		<div class="row">
				<div class="col-md-12">

					<h3 class="page-header">Dados gerais do usuário {{ $user->nome_usuario }}</h3>

					<p> Usuário ativo desde : {{ $ativo_desde }}</p>
	          			
					<p><a href="{{ URL::to('/users/' . Session::get('id_atual') .'/edit') }}" class="btn btn-primary"> Editar dados de usuario </a></p>
	          		<hr>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-12 my-auto">

					<div class="container-fluid">

						<div class="row">

							<div class="col-lg-6">
			                  <div class="feature-item">
			                    <i class="icon-user text-primary"></i>
			                    <h3>Dados do parceiro</h3>

			                    @if( empty($vendedor))
				            		<h4>Nenhum dado do parceiro cadastrado ainda.</h4>
				    			@else

				    				<p class="text-muted"><b>Nome completo :</b> {{ $vendedor->nome_vendedor }}</p>

				    				@if( !empty($vendedor->nome_fantasia ))
				    					<p class="text-muted"><b>Nome completo :</b> {{ $vendedor->nome_fantasia }}</p>
				    				@endif

				    				<p class="text-muted"><b>R.G :</b> {{ $vendedor->rg_vendedor }}</p>

				    				<p class="text-muted"><b>CPF/CNPJ :</b> {{ $vendedor->cnpj_cpf }}</p>

				    			@endif

				    			<p><a href="{{ URL::to('/vendedores/' . Session::get('id_atual') . '/edit') }}" class="btn btn-primary"> Editar dados </a></p>

			                  </div>
			                </div>


			                <div class="col-lg-6">
			                  <div class="feature-item">
			                    <i class="icon-phone text-primary"></i>
			                    <h3>Dados de contatos</h3>
			                    
			                    @if( empty($telefones))
				            		<h4>Nenhum telefone  cadastrado ainda.</h4>
				    			@else

				    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

				    					<thead>
				                            <tr>
				                                <th>Telefone</th>
				                                <th>Observação</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                        	@if(!empty($telefones))
			                     		
			                     				@foreach($telefones->all() as $telefone)
			                     					<tr>
					                                    <td>
					                                        {{ $telefone->telefone }}
					                                    </td>
					                                    <td>
					                                        {{ $telefone->observacacao_telefone }}
					                                    </td>

					                                </tr>
			                     				@endforeach

			                     			@endif

				                        </tbody>
				    				</table>

				    			@endif

				    			<p><a href="{{ URL::to('/telefones/' . Session::get('id_atual')) }}" class="btn btn-primary"> Gerenciar contatos </a></p>

			                  </div>
			                </div>

						</div>

						<div class="row">
							
							<div class="col-lg-6">
			                  <div class="feature-item">
			                    <i class="icon-directions text-primary"></i>
			                    <h3>Dados do endereço</h3>
			                    <!-- <p class="text-muted">Faça suas indicações quando achar mais apropriado!</p> -->
			                    @if( empty($enderecos))
				            		<h4>Nenhum endereço cadastrado ainda.</h4>
				    			@else

				    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

				    					<thead>
				                            <tr>
			 									<th>Logradouro</th>
			                                    <th>Cidade</th>
			                                    <th>Uf</th>
				                            </tr>
				                        </thead>	
				                        <tbody>
				                        	@if(!empty($enderecos))
                                            
                                    			@foreach($enderecos->all() as $endereco)

                                    				<tr>
				                                        <td>
				                                            {{ $endereco->logradouro }}
				                                        </td>
				                                        <td>
				                                            {{ $endereco->cidade }}
				                                        </td>
				                                        <td>
				                                            @foreach($estados->all() as $estado)

				                                                @if($estado->id_estado == $endereco->uf)
				                                                    {{ $estado->nome_estado }}
				                                                @endif

				                                            @endforeach
				                                        </td>
				                                    </tr>

                                    			@endforeach

                                    		@endif
				                        </tbody>
				    				</table>

			                    @endif
			                    <p><a href="{{ URL::to('/enderecos/' . Session::get('id_atual')) }}" class="btn btn-primary"> Gerenciar contatos </a></p>
			                  </div>
			                </div>
			                <div class="col-lg-6">
			                  <div class="feature-item">
			                    <i class="icon-diamond text-primary"></i>
			                    <h3>Dados financeiro</h3>
			                    @if( empty($informacoes_bancarias))
				            		<h4>Nenhum dado bancario cadastrado ainda.</h4>
				    			@else

				    				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

				    					<thead>
				                            <tr>
				                                <th>Nome conta</th>
				                                <th>Número</th>
				                                <th>Tipo conta</th>
				                                <th>Instituição</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                        	@if(!empty($informacoes_bancarias))
										
												@foreach($informacoes_bancarias->all() as $conta)

													<tr>
					                                    <td>
					                                        {{ $conta->nome_conta }}
					                                    </td>
					                                    <td>
					                                        {{ $conta->numero_conta }}
					                                    </td>
					                                    <td>
					                                        @foreach($tipo_contas->all() as $tipo_conta)

					                                            @if($tipo_conta->id_tipo_conta == $conta->tipo_conta)
					                                                {{ $tipo_conta->tipo_conta }}
					                                            @endif

					                                        @endforeach
					                                    </td>
					                                    <td>
					                                        @foreach($lista_bancos->all() as $banco)

					                                            @if($banco->id_instituicao_bancaria == $conta->instituicao )
					                                                {{ $banco->nome_instituicao_bancaria }}
					                                            @endif

					                                        @endforeach
					                                    </td>
					                                </tr>

												@endforeach


											@endif

				                        </tbody>

				    				</table>

			                    @endif
			                    <p><a href="{{ URL::to('/financas/' . Session::get('id_atual')) }}" class="btn btn-primary"> Gerenciar contatos </a></p>
			                  </div>
			                </div>

						</div>

					</div>

				</div>

			</div>

    	</div>
    </section>

@endsection()