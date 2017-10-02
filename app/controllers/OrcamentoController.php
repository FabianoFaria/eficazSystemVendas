<?php

class OrcamentoController extends \BaseController {


	public function __construct(Orcamentos $Orcamentos){
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->Orcamentos = $Orcamentos;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$id_user 			= Session::get('id_atual');
		$status_usuario 	= Session::get('status');
		$dadosVendedor 		= VendedoresDados::where('id_user', $id_user)->first();

		$orcamentoParceiro  = $this->Orcamentos->orcamentoUsuario($id_user);

		$dados 				= [
			'dadosVendedor' => $dadosVendedor, 
			'orcamentos' 	=> $orcamentoParceiro
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.telefones', $dados);

			break;
				
			case 'Parceiros':
				
				return View::make( 'orcamentos.parceiros_orcamentos', $dados);

			break;

			case 'Cliente':
				# code...
			break;
		}

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

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.telefones', $dados);

			break;
				
			case 'Parceiros':
				
				return View::make( 'orcamentos.clientes_create', $dados);

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
		if( ! $this->Orcamentos->isValid($input = Input::all() )){

			return Redirect::back()->withInput()->withErrors($this->Orcamentos->errors);

		}else{

			$this->Orcamentos->id_cliente	= Input::get('id_cliente_indicado');
			$this->Orcamentos->id_user 		= Input::get('id_usuario');

			//Inicia pacote para enviar dados para API
			$client = new \GuzzleHttp\Client();   

			//$r = $client->post('http://127.0.0.1/apiEficaz/public/api/criarNovoOrcamentoCliente',
			$r = $client->post('https://api.eficazsystem.com.br/api/criarNovoOrcamentoCliente', 
                ['json' => [
                    "Cadastro_ID" 	=>	Input::get('id_cliente_indicado'),
                    "Titulo" 		=> 	Input::get('titulo_orcamento'),
                    "Descricao"		=>	Input::get('descricao_orcamento')
                ]]);

			$statusRequisicao 	= $r->getStatusCode();
			$resultado			= $r->json();

			switch ($statusRequisicao) {

				case '201':

					# Cadastro foi efetuado com sucesso
					# Cliente será salvo no cadastro do parceiro
					$this->Orcamentos->id_orcamento_sistema = $resultado['Workflow_ID'];

					$this->Orcamentos->save();

					return Redirect::route('orcamentos.show', Session::get('cliente_atual'));

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

		//$orcamentosCliente 	= Orcamentos::where('id_cliente', $dadosCliente->id_cliente_sistema_eficaz)->get();
		$orcamentosCliente 	= DB::table('orcamentos_indicados')->where('id_cliente', '=', $dadosCliente->id_cliente_sistema_eficaz)->get();

		$arrayOrcamentos	= array();

		//Inicia pacote para enviar dados para API
		$client = new \GuzzleHttp\Client();

		if(!empty($orcamentosCliente)){

			foreach ($orcamentosCliente as $orcamento) { 
				
				// Envia requisição para a API e recuperar o status dos orçamentos
				//$r = $client->get('http://127.0.0.1/apiEficaz/public/api/statusOrcamentoCliente/'.$orcamento->id_orcamento_sistema, 
				$r = $client->get('https://api.eficazsystem.com.br/api/statusOrcamentoCliente/'.$orcamento->id_orcamento_sistema, 
	                ['json' => [
	                    "Cadastro_ID" 	=>	Input::get('id_cliente_indicado'),
	                    "Titulo" 		=> 	Input::get('titulo_orcamento'),
	                    "Descricao"		=>	Input::get('descricao_orcamento')
	                ]]);

				$statusRequisicao 	= $r->getStatusCode();
				$resultado			= $r->json();

				switch ($statusRequisicao) {

					case '200':

						//dd($resultado);

						if( !empty($resultado)){

							$dateTemp = $resultado['Data_Abertura'];

							$data  	  = explode(' ',$dateTemp);

							$resultado['Data_Abertura'] = implode('/', array_reverse(explode('-', $data[0])));

							array_push($arrayOrcamentos ,$resultado);
						}

					break;

					// case '201':

					// 	if(!empty($resultado) && $resultado != '404'){
							
					// 		$dateTemp = $resultado[0]['Data_Abertura'];

					// 		$data  	  = explode(' ',$dateTemp);

					// 		$resultado[0]['Data_Abertura'] = implode('/', array_reverse(explode('-', $data[0])));

					// 		array_push($arrayOrcamentos ,$resultado[0]);
					// 	}
					// break;

					case '404':
						echo 'Falha ao encontrar.';
					break;

					default:
						echo 'Falha ao encontrar.';
					break;
				}

			}	
		}

		Session::put('cliente_atual', $id);

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente,
			'orcamentos' 	=> $arrayOrcamentos
		];

		//dd($arrayOrcamentos);

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.telefones', $dados);

			break;
				
			case 'Parceiros':
				
				return View::make( 'orcamentos.clientes_orcamentos', $dados);

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
	}


}
