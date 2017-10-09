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

		//dd($orcamentoParceiro);

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
			// http://127.0.0.1/apiEficaz/public
			$r = $client->post('http://127.0.0.1/apiEficaz/public/api/criarNovoOrcamentoCliente', 
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
		$orcamentosCliente 	= DB::table('orcamentos_indicados')
								->where('id_cliente', '=', $dadosCliente->id_cliente_sistema_eficaz)
								->get();

		$arrayOrcamentos	= array();

		//Inicia pacote para enviar dados para API
		$client = new \GuzzleHttp\Client();

		if(!empty($orcamentosCliente)){

			foreach ($orcamentosCliente as $orcamento) { 
				
				// Envia requisição para a API e recuperar o status dos orçamentos
				//$r = $client->get('http://127.0.0.1/apiEficaz/public/api/statusOrcamentoCliente/'.$orcamento->id_orcamento_sistema, 
				$r = $client->get('http://127.0.0.1/apiEficaz/public/api/statusOrcamentoCliente/'.$orcamento->id_orcamento_sistema, 
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

	/**
	 * Retorna o total a ser pago para o parceiro em comissôes.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function contabilizarComissaoParceiro()
	{

		//
		$id_user 			= Session::get('id_atual');
		$status_usuario 	= Session::get('status');
		$dadosVendedor 		= VendedoresDados::where('id_user', $id_user)->first();
		$dadosCliente 		= ClientesIndicacoes::where('id_user', $id_user)->get();

		$orcamentosCliente 	= DB::table('orcamentos_indicados')
							->where('id_user', '=', $id_user)
							->get();

		$arrayOrcamentos	= array();

		//Inicia pacote para enviar dados para API
		$client = new \GuzzleHttp\Client();

		if(!empty($orcamentosCliente)){

			foreach ($orcamentosCliente as $orcamento) { 

				$r = $client->get('http://127.0.0.1/apiEficaz/public/api/orcamentoClienteDetalhado/'.$orcamento->id_orcamento_sistema
					);

				$statusRequisicao 	= $r->getStatusCode();
				$resultado			= $r->json();

				switch ($statusRequisicao) {

					case '200':

						//dd($resultado);

						if( !empty($resultado)){

							// $dateTemp = $resultado['Data_Finalizado'];

							// $data  	  = explode(' ',$dateTemp);

							// $resultado['Data_Finalizado'] = implode('/', array_reverse(explode('-', $data[0])));
 							
 							//Exibe apenas o total da comissão a ser pago pelo orcamento
							//$resultado['totalServico'] = Orcamentos::comissaoOrcamentoAulso($resultado['totalServico']);


							//Adiciona o número de dias para calcular a data de faturamento
							//$dateTemp = date($resultado['Data_Finalizado'], strtotime("+".$resultado['Dias_Vencimento']." days"));

							//$dateTemp = strtotime(date("Y-m-d H:i:s", strtotime()) . " +".$resultado['Dias_Vencimento']."days");
							$diasParaFaturar = $resultado['Dias_Vencimento'];

							$dateTemp = strtotime($resultado['Data_Finalizado']." +".$diasParaFaturar."days");

						    //$date = strtotime($dateTemp);
    						$date = date("l", $dateTemp);

    						switch ($date) {
    							case 'Saturday':
    								$diasParaFaturar = $diasParaFaturar + 2;

						        	$dateTemp = strtotime($resultado['Data_Finalizado']." +".$diasParaFaturar."days");


						        	$resultado['Data_Faturamento'] = date("Y-m-d H:i:s", $dateTemp);

    							break;

    							case 'Sunday':
    								
    								$diasParaFaturar = $diasParaFaturar + 1;

						        	$dateTemp = strtotime($resultado['Data_Finalizado']." +".$diasParaFaturar."days");

						        	$resultado['Data_Faturamento'] = date("Y-m-d H:i:s", $dateTemp);

    							break;
    							
    							default:
    								
    								$resultado['Data_Faturamento'] = date("Y-m-d H:i:s", $dateTemp);

    							break;
    						}

						    

						    //

							/*
								
								'Titulo' => string 'Baterias juarez - bancos de baterias' (length=36)
							    'Data_Finalizado' => string '05/10/2017' (length=10)
							    'Proposta_ID' => int 414
							    'Forma_Pagamento_ID' => int 1357
							    'Data_Vencimento' => null
							    'Dias_Vencimento' => int 30
							    'Valor_Vencimento' => string '899.60' (length=6)
									
							*/

							array_push($arrayOrcamentos ,$resultado);
						}

					break;

					case '404':
						echo 'Falha ao encontrar.';
					break;

					default:
						echo 'Falha ao encontrar.';
					break;

				}

			}

			dd($arrayOrcamentos);

		}

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente,
			'orcamentos' 	=> $arrayOrcamentos
		];

		//dd($dadosVendedor);

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.telefones', $dados);

			break;
				
			case 'Parceiros':
				
				return View::make( 'orcamentos.parceiro_orcamentos_comicoes', $dados);

			break;

			case 'Cliente':
				# code...
			break;
		}

	}


}
