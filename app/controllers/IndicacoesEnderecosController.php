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
		$dadosCliente 		= ClientesIndicacoes::find(Session::get('cliente_atual'));
		$estados 			= EstadosPais::all();

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente,
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

			$this->clientesEnderecos->id_cliente_indicado 	= Input::get('id_cliente_indicado');
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

			$r = $client->post('http://127.0.0.1/apiEficaz/public/api/criarEnderecoContato', 
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
		$dadosCliente 		= ClientesIndicacoes::find($id);
		$enderecosClientes 	= ClientesEnderecos::where('id_cliente_indicado', $id)->get();
		$estados 			= EstadosPais::all();

		//Armazena o id do cliente para uso futuro
		Session::put('cliente_atual', $id);

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente,
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

		$dadosCliente 		= ClientesIndicacoes::find(Session::get('cliente_atual'));
		$enderecoClientes 	= ClientesEnderecos::find($id);
		$estados 			= EstadosPais::all();

		$dados  		= [
			'dadosVendedor' => $dadosVendedor,
			'dadosCliente'	=> $dadosCliente,
			'enderecos' 	=> $enderecoClientes,
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
		$id_endereco = Input::get('id_endereco');

		$this->clientesEnderecos = ClientesEnderecos::find($id_endereco);

		//dd(Input::all());

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

			$r = $client->put('http://127.0.0.1/apiEficaz/public/api/editarEnderecoContato/'.Input::get('id_endereco_sistema'), 
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
		$endereco = ClientesEnderecos::find($id);

		//Inicia pacote para enviar dados para API
		$client = new \GuzzleHttp\Client();

		$r = $client->delete('http://127.0.0.1/apiEficaz/public/api/removerEnderecoContato/'.$endereco->id_endereco_sistema_eficaz, 
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
