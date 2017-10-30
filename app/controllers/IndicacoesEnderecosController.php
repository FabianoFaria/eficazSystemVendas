<?php

class IndicacoesEnderecosController extends \BaseController {

	public function __construct(ClientesEnderecos $ClientesEnderecos) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->clientesEnderecos = $ClientesEnderecos;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$id_user 			= Session::get('id_atual');
		$status_usuario 	= Session::get('status');
		$dadosVendedor 		= VendedoresDados::where('id_user', $id_user)->first();
		$id_parceiro_system = $dadosVendedor->id_parceiro_sistema;
		//$dadosCliente 		= ClientesIndicacoes::find(Session::get('cliente_atual'));
		$dadosCliente 		= ClientesIndicacoes::pesquisarIndicacao(Session::get('cliente_atual'), $id_parceiro_system);
		$estados 			= EstadosPais::all();

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente[0],
			'estados'		=> $estados
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.clientes_create', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'enderecos.clientes_create', $dados);

			break;

			case 'Cliente':
				# code...
			break;
		}

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		//
		if( ! $this->clientesEnderecos->isValid($input = Input::all() )){

			return Redirect::back()->withInput()->withErrors($this->clientesEnderecos->errors);

		}else{

			//Dados do cliente
			$dadosClienteLocal  = ClientesIndicacoes::where('id_cliente_sistema_eficaz', Input::get('id_cliente_indicado'))->first();

			//dd($dadosClienteLocal);

			//$this->clientesEnderecos->id_cliente_indicado 	= Input::get('id_cliente_indicado');
			$this->clientesEnderecos->id_cliente_indicado 	= $dadosClienteLocal->id_cliente_indicado;
			$this->clientesEnderecos->logradouro 			= Input::get('logradouro');
			$this->clientesEnderecos->numero 				= Input::get('numero');
			$this->clientesEnderecos->complemento 			= Input::get('complemento');
			$this->clientesEnderecos->bairro 				= Input::get('bairro');
			$this->clientesEnderecos->cidade 				= Input::get('cidade');
			$this->clientesEnderecos->uf 					= Input::get('estado_endereco');
			$this->clientesEnderecos->status_endereco 		= 1;
			$this->clientesEnderecos->cep_endereco 			= Input::get('cep');

			//EFETUAR FILTRO DE ESTADOS PARA PASSAR PARA A API
			$estados 			= EstadosPais::all();
			$sigla				= '';

			foreach ($estados as $estado) {
				if($estado->id_estado == Input::get('estado_endereco')){
					$sigla = $estado->sigla_estado;
				}
			}

			//Inicia pacote para enviar dados para API
			$client = new \GuzzleHttp\Client();

			//$r = $client->post('https://api.eficazsystem.com.br/api/criarEnderecoContato', 
			$r = $client->post('https://api.eficazsystem.com.br/api/criarEnderecoContato', 
                ['json' => [
                    "Cadastro_ID" 		=>	Input::get('id_cliente_sistema'),
                    "CEP" 				=> 	Input::get('cep'),
                    "Logradouro"		=>	Input::get('logradouro'),
                    "Numero"			=>	Input::get('numero'),
                    "Complemento"		=>	Input::get('complemento'),
                    "Bairro"			=>	Input::get('bairro'),
                    "Cidade"			=>	Input::get('cidade'),
                    "UF"				=>	$sigla
                ]]);


			$statusRequisicao 	= $r->getStatusCode();
			$resultado			= $r->json();

			//dd($statusRequisicao);

			switch ($statusRequisicao) {
				case '201':

					# Cadastro foi efetuado com sucesso
					# Cliente será salvo no cadastro do parceiro
					$this->clientesEnderecos->id_endereco_sistema_eficaz = $resultado['Cadastro_Endereco_ID'];

					$this->clientesEnderecos->save();

					return Redirect::route('enderecos_indicacoes.show', Session::get('cliente_atual'));

				break;
				
				case '400':
			
					Session::flash('error_cad', 'Não foi possivel cadastrar, verifique os dados informado e tente novamente.');

					return Redirect::back()->withInput();


				break;
				default:
					# Caso tenha ocorrido um erro de servidor
					Session::flash('error_cad', 'Não foi possivel cadastrar no momento, tente novamente em alguns instante.');

					return Redirect::back()->withInput();

				break;
			}

		}

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$id_user 			= Session::get('id_atual');
		$status_usuario 	= Session::get('status');
		$dadosVendedor 		= VendedoresDados::where('id_user', $id_user)->first();
		$id_parceiro_system = $dadosVendedor->id_parceiro_sistema;
		//$dadosCliente 		= ClientesIndicacoes::find($id);
		$dadosCliente 		= ClientesIndicacoes::pesquisarIndicacao($id, $id_parceiro_system);
		//$enderecosClientes 	= ClientesEnderecos::where('id_cliente_indicado', $id)->get();
		$enderecosClientes 	= ClientesEnderecos::pesquisarEnderecosIndicacao($id);

		// dd($dadosCliente);
		// dd($enderecosClientes);


		$estados 			= EstadosPais::all();

		//Armazena o id do cliente para uso futuro
		Session::put('cliente_atual', $id);

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente[0],
			'enderecos' 	=> $enderecosClientes,
			'estados' 		=> $estados
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.telefones', $dados);

			break;
				
			case 'Parceiros':
				
				return View::make( 'enderecos.clientes_enderecos', $dados);

			break;

			case 'Cliente':
				# code...
			break;
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$id_user 			= Session::get('id_atual');
		$clie_id 			= Session::get('cliente_atual');
		$status_usuario 	= Session::get('status');
		$dadosVendedor 		= VendedoresDados::where('id_user', $id_user)->first();
		$id_parceiro_system = $dadosVendedor->id_parceiro_sistema;
		//$dadosCliente 		= ClientesIndicacoes::find(Session::get('cliente_atual'));
		$dadosCliente 		= ClientesIndicacoes::pesquisarIndicacao($clie_id, $id_parceiro_system); 
		//$enderecoClientes 	= ClientesEnderecos::find($id);
		$enderecoClientes 	= ClientesEnderecos::carregarEnderecosIndicacao($id);
		$estados 			= EstadosPais::all();

		//dd($enderecoClientes);

		$dados  		= [
			'dadosVendedor' => $dadosVendedor,
			'dadosCliente'	=> $dadosCliente[0],
			'enderecos' 	=> $enderecoClientes[0],
			'estados' 		=> $estados
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.telefones', $dados);

			break;
				
			case 'Parceiros':
				
				return View::make( 'enderecos.clientes_edit', $dados);

			break;

			case 'Cliente':
				# code...
			break;
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		$id_endereco = Input::get('id_endereco_sistema');

		//$this->clientesEnderecos = ClientesEnderecos::find($id_endereco);

		$this->clientesEnderecos = ClientesEnderecos::where('id_endereco_sistema_eficaz', $id_endereco)->first();

		//dd($this->clientesEnderecos);
		if(empty($this->clientesEnderecos)){

			
			$clie_id 			= Input::get('id_cliente');

			$dadosClienteLocal  = ClientesIndicacoes::where('id_cliente_sistema_eficaz', $clie_id)->first();

			//dd($dadosClienteLocal);

			$this->clientesEnderecos = new ClientesEnderecos();
			$this->clientesEnderecos->id_endereco_sistema_eficaz 	= Input::get('id_endereco_sistema');
			$this->clientesEnderecos->id_cliente_indicado 			= $dadosClienteLocal->id_cliente_indicado;		
		}


		//dd($this->clientesEnderecos->isValid($input = Input::all()));

		if( ! $this->clientesEnderecos->isValid($input = Input::all())){

			return Redirect::back()->withInput()->withErrors($this->clientesEnderecos->errors);

		}else{

			$this->clientesEnderecos->logradouro 			= Input::get('logradouro');
			$this->clientesEnderecos->numero 				= Input::get('numero');
			$this->clientesEnderecos->complemento 			= Input::get('complemento');
			$this->clientesEnderecos->bairro 				= Input::get('bairro');
			$this->clientesEnderecos->cidade 				= Input::get('cidade');
			//$this->clientesEnderecos->uf 					= Input::get('estado_endereco');
			$this->clientesEnderecos->status_endereco 		= 1;
			$this->clientesEnderecos->cep_endereco 			= Input::get('cep');

			//EFETUAR FILTRO DE ESTADOS PARA PASSAR PARA A API
			$estados 			= EstadosPais::all();
			$sigla				= '';

			foreach ($estados as $estado) {
				if($estado->id_estado == Input::get('estado_endereco')){
					$sigla = $estado->sigla_estado;
				}
			}

			//Inicia pacote para enviar dados para API 
			$client = new \GuzzleHttp\Client();

			//$r = $client->put('https://api.eficazsystem.com.br/api/editarEnderecoContato/'.Input::get('id_endereco_sistema'), 
			$r = $client->put('https://api.eficazsystem.com.br/api/editarEnderecoContato/'.Input::get('id_endereco_sistema'), 
                ['json' => [
                    "Cadastro_Endereco_ID" 	=>	Input::get('id_endereco_sistema'),
                    "CEP" 				=> 	Input::get('cep'),
                    "Logradouro"		=>	Input::get('logradouro'),
                    "Numero"			=>	Input::get('numero'),
                    "Complemento"		=>	Input::get('complemento'),
                    "Bairro"			=>	Input::get('bairro'),
                    "Cidade"			=>	Input::get('cidade'),
                    "UF"				=>	$sigla
                ]]);

			$statusRequisicao 	= $r->getStatusCode();
			$resultado			= $r->json();

			switch ($statusRequisicao) {
				case '201':

					# Cadastro foi efetuado com sucesso
					# Cliente será salvo no cadastro do parceiro
					//$this->clientesEnderecos->id_endereco_sistema_eficaz = $resultado['Cadastro_Endereco_ID'];

					$this->clientesEnderecos->save();

					return Redirect::route('enderecos_indicacoes.show', Session::get('cliente_atual'));

				break;
				
				case '400':
			
					Session::flash('error_cad', 'Não foi possivel cadastrar, verifique os dados informado e tente novamente.');

					return Redirect::back()->withInput();


				break;
				default:
					# Caso tenha ocorrido um erro de servidor
					Session::flash('error_cad', 'Não foi possivel cadastrar no momento, tente novamente em alguns instante.');

					return Redirect::back()->withInput();

				break;
			}
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		//$endereco = ClientesEnderecos::find($id);
		$endereco = ClientesEnderecos::where('id_endereco_sistema_eficaz', $id)->first();

		//dd($endereco);

		//Inicia pacote para enviar dados para API 
		$client = new \GuzzleHttp\Client();

		//$r = $client->delete('https://api.eficazsystem.com.br/api/removerEnderecoContato/'.$endereco->id_endereco_sistema_eficaz, 
		$r = $client->delete('https://api.eficazsystem.com.br/api/removerEnderecoContato/'.$endereco->id_endereco_sistema_eficaz, 
                ['json' => [
                    "Cadastro_Endereco_ID" 	=>	$endereco->id_endereco_sistema_eficaz
                ]]);

		$statusRequisicao 	= $r->getStatusCode();
		$resultado			= $r->json();

		$endereco->delete();

		switch ($statusRequisicao) {

			case '200':
				# Requisição foi concluida com sucesso

				$endereco->delete();

				return Redirect::route('enderecos_indicacoes.show',Session::get('cliente_atual'));
			break;
			case '201':

				# Cadastro foi efetuado com sucesso
				# Cliente será salvo no cadastro do parceiro
				$endereco->delete();

				return Redirect::route('enderecos_indicacoes.show',Session::get('cliente_atual'));

			break;
				
			case '400':
			
				Session::flash('error_cad', 'Não foi possivel remover, verifique os dados informado e tente novamente.');

				return Redirect::route('enderecos_indicacoes.show',Session::get('cliente_atual'));


			break;
			case '401':
				Session::flash('error_cad', 'Não foi possivel remover, operação não autorizada.');

				return Redirect::route('enderecos_indicacoes.show',Session::get('cliente_atual'));
			break;
			default:
				# Caso tenha ocorrido um erro de servidor
				Session::flash('error_cad', 'Não foi possivel remover no momento, tente novamente em alguns instante.');

				return Redirect::route('enderecos_indicacoes.show',Session::get('cliente_atual'));

			break;

		}
	}


}
