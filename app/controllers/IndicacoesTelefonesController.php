<?php

class IndicacoesTelefonesController extends \BaseController {

	public function __construct(ClientesTelefones $ClientesTelefones) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->clientesTelefones = $ClientesTelefones;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	//Metodo alterado para receber a $idCliente
	public function index($idCliente)
	{
		//
		// $id_user 		= Session::get('id_atual');
		// $status_usuario = Session::get('status');
		// $dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		// //$dadosCliente 	= ClientesIndicacoes::where('',)->first();

		// return $idCliente." index.";

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	//Passando $id do cliente para cadastrar o telefone
	public function create()
	{
		//
		$id_user 			= Session::get('id_atual');
		$status_usuario 	= Session::get('status');
		$dadosVendedor 		= VendedoresDados::where('id_user', $id_user)->first();
		$id_parceiro_system = $dadosVendedor->id_parceiro_sistema;
		//$dadosCliente 		= ClientesIndicacoes::find(Session::get('cliente_atual'));
		$dadosCliente 		= ClientesIndicacoes::pesquisarIndicacao(Session::get('cliente_atual'), $id_parceiro_system);

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente[0]
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.clientes_create', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'telefones.clientes_create', $dados);

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
		if( ! $this->clientesTelefones->isValid($input = Input::all() )){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->clientesTelefones->errors);

		}else{

			//Dados do cliente
			$dadosClienteLocal  = ClientesIndicacoes::where('id_cliente_sistema_eficaz', Input::get('id_cliente_indicado'))->first();

			//dd($dadosClienteLocal);

			// $this->clientesTelefones->id_cliente_indicado 	= Input::get('id_cliente_indicado');
			$this->clientesTelefones->id_cliente_indicado 	= $dadosClienteLocal->id_cliente_indicado;
			$this->clientesTelefones->telefone_cliente 		= Input::get('telefone');
			$this->clientesTelefones->observacao_telefone 	= Input::get('observacao');

			//Inicia pacote para enviar dados para API
			$client = new \GuzzleHttp\Client();

			//$r = $client->post('https://api.eficazsystem.com.br/api/criarTelefoneContato', 
			$r = $client->post('https://api.eficazsystem.com.br/api/criarTelefoneContato', 
                ['json' => [
                    "Cadastro_ID" 		=>	Input::get('id_sistema_eficaz'),
                    "Telefone" 			=> 	Input::get('telefone'),
                    "Observacao"		=>	Input::get('observacao'),
                ]]);

			$statusRequisicao 	= $r->getStatusCode();
			$resultado			= $r->json();


			switch ($statusRequisicao) {
				case '201':

					# Cadastro foi efetuado com sucesso
					# Cliente será salvo no cadastro do parceiro
					$this->clientesTelefones->id_telefone_sistema_eficaz = $resultado['Cadastro_Telefone_ID'];

					$this->clientesTelefones->save();

					return Redirect::route('telefones_indicacoes.show', Session::get('cliente_atual'));

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

		$telefonesClientes 	= ClientesTelefones::where('id_cliente_indicado', $id)->get();
		//$telefonesClientes 	= DB::table('clientes_telefones')->where('id_cliente_indicado', $id)->get();

		$telefonesClientes	= ClientesTelefones::pesquisarTelefonesIndicacao($id);

		//dd($dadosCliente);
		//dd($telefonesClientes);


		//Armazena o id do cliente para uso futuro
		Session::put('cliente_atual', $id);

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente[0],
			'telefones' 	=> $telefonesClientes
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.telefones', $dados);

			break;
				
			case 'Parceiros':
				
				return View::make( 'telefones.clientes_index', $dados);

			break;

			case 'Cliente':
				# code...
			break;
		}


		//return $id;
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
		//$clie_id 		= Session::get('cliente_atual');
		$status_usuario 	= Session::get('status');
		$dadosVendedor 		= VendedoresDados::where('id_user', $id_user)->first();
		//$dadosTelefones = VendedoresTelefones::where('id_user', $id_user)->first();
		$id_parceiro_system = $dadosVendedor->id_parceiro_sistema;
		// $dadosCliente 	= ClientesIndicacoes::find(Session::get('cliente_atual'));
		//$dadosTelefones = ClientesTelefones::find($id);
		$dadosTelefones 	= ClientesTelefones::carregartelefoneIndicacao($id); 

		$dadosCliente 		= ClientesIndicacoes::pesquisarIndicacao($dadosTelefones[0]['Cadastro_ID'], $id_parceiro_system);

		// dd($dadosCliente);

		$dados  		= [
			'dadosVendedor' => $dadosVendedor,
			'dadosCliente'	=> $dadosCliente[0],
			'telefones' 	=> $dadosTelefones[0],
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.telefones', $dados);

			break;
				
			case 'Parceiros':
				
				return View::make( 'telefones.clientes_edit', $dados);

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
		$id_telefone = Input::get('id_sistema_eficaz');

		//$this->clientesTelefones = ClientesTelefones::find($id_telefone);

		$this->clientesTelefones = ClientesTelefones::where('id_telefone_sistema_eficaz', $id_telefone)->first();

		if(empty($this->clientesTelefones)){

			$clie_id 			= Input::get('id_cliente');

			$dadosClienteLocal  = ClientesIndicacoes::where('id_cliente_sistema_eficaz', $clie_id)->first();

			$this->clientesTelefones = new ClientesTelefones();
			$this->clientesTelefones->id_telefone_sistema_eficaz 	= Input::get('id_sistema_eficaz');
			$this->clientesTelefones->id_cliente_indicado 			= $dadosClienteLocal->id_cliente_indicado;

		}

		if( ! $this->clientesTelefones->isValid($input = Input::all())){

			return Redirect::back()->withInput()->withErrors($this->clientesTelefones->errors);

		}else{

			$this->clientesTelefones->telefone_cliente 		= Input::get('telefone');
			$this->clientesTelefones->observacao_telefone	= Input::get('observacao');

			//dd(Input::all());

			//Inicia pacote para enviar dados para API 
			$client = new \GuzzleHttp\Client();

			// $r = $client->put('https://api.eficazsystem.com.br/api/editarTelefoneContato/'.Input::get('id_sistema_eficaz'),
			$r = $client->put('https://api.eficazsystem.com.br/api/editarTelefoneContato/'.Input::get('id_sistema_eficaz'),
                ['json' => [
                    "Cadastro_Telefone_ID" 	=>	Input::get('id_sistema_eficaz'),
                    "Telefone" 				=> 	Input::get('telefone'),
                    "Observacao"			=>	Input::get('observacao'),
                ]]);

			$statusRequisicao 	= $r->getStatusCode();
			$resultado			= $r->json();


			switch ($statusRequisicao) {
				case '201':

					# Cadastro foi efetuado com sucesso
					# Cliente será salvo no cadastro do parceiro
					$this->clientesTelefones->save();

					return Redirect::route('telefones_indicacoes.show', Session::get('cliente_atual'));

				break;
				
				case '400':
			
					Session::flash('error_cad', 'Não foi possivel atualizar, verifique os dados informado e tente novamente.');

					return Redirect::back()->withInput();


				break;
				default:
					# Caso tenha ocorrido um erro de servidor
					Session::flash('error_cad', 'Não foi possivel atualizar no momento, tente novamente em alguns instante.');

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
		//$telefone = ClientesTelefones::find($id);
		$telefone = ClientesTelefones::where('id_telefone_sistema_eficaz', $id)->first();

		//Inicia pacote para enviar dados para API
		$client = new \GuzzleHttp\Client(); 

		//$r = $client->delete('https://api.eficazsystem.com.br/api/removerTelefoneContato/'.$telefone->id_telefone_sistema_eficaz, 
		$r = $client->delete('https://api.eficazsystem.com.br/api/removerTelefoneContato/'.$telefone->id_telefone_sistema_eficaz, 
                ['json' => [
                    "Cadastro_Telefone_ID" 	=>	$telefone->id_telefone_sistema_eficaz
                ]]);

		$statusRequisicao 	= $r->getStatusCode();
		$resultado			= $r->json();

		$telefone->delete();

		switch ($statusRequisicao) {

			case '200':
				# Requisição foi concluida com sucesso

				$telefone->delete();

				return Redirect::route('telefones_indicacoes.show',Session::get('cliente_atual'));
			break;
			case '201':

				# Cadastro foi efetuado com sucesso
				# Cliente será salvo no cadastro do parceiro
				$telefone->delete();

				return Redirect::route('telefones_indicacoes.show',Session::get('cliente_atual'));

			break;
				
			case '400':
			
				Session::flash('error_cad', 'Não foi possivel remover, verifique os dados informado e tente novamente.');

				return Redirect::route('telefones_indicacoes.show',Session::get('cliente_atual'));


			break;
			case '401':
				Session::flash('error_cad', 'Não foi possivel remover, operação não autorizada.');

				return Redirect::route('telefones_indicacoes.show',Session::get('cliente_atual'));
			break;
			default:
				# Caso tenha ocorrido um erro de servidor
				Session::flash('error_cad', 'Não foi possivel remover no momento, tente novamente em alguns instante.');

				return Redirect::route('telefones_indicacoes.show',Session::get('cliente_atual'));

			break;
		}

	}


}
