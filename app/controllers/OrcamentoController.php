<?php

use \GuzzleHttp\Exception\RequestException;

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

		$id_sistema 		= $dadosVendedor->id_parceiro_sistema;
		//dd($id_sistema);

		//$orcamentoParceiro  = $this->Orcamentos->orcamentoUsuario($id_user);

		$orcamentoParceiro  = Orcamentos::orcamentosSistema($id_sistema);

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

			//$r = $client->post('https://api.eficazsystem.com.br/api/criarNovoOrcamentoCliente',
			// http://127.0.0.1/apiEficaz/public
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
		//$dadosCliente 		= ClientesIndicacoes::find($id);

		//dd($dadosVendedor->id_parceiro_sistema);
		$id_parceiro_system = $dadosVendedor->id_parceiro_sistema;

		$dadosCliente 		= ClientesIndicacoes::pesquisarIndicacao($id, $id_parceiro_system);

		//$orcamentosCliente 	= Orcamentos::where('id_cliente', $dadosCliente->id_cliente_sistema_eficaz)->get();
		//$orcamentosCliente 	= DB::table('orcamentos_indicados')
		//						->where('id_cliente', '=', $dadosCliente->id_cliente_sistema_eficaz)
		//						->get();

		$orcamentosCliente 	= Orcamentos::orcamentosClienteSistema($dadosCliente[0]['Cadastro_ID']);

		//dd($dadosCliente);

		Session::put('cliente_atual', $id);

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'dadosCliente' 	=> $dadosCliente[0],
			'orcamentos' 	=> $orcamentosCliente
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
		$id_user 					= Session::get('id_atual');
		$status_usuario 			= Session::get('status');
		$dadosVendedor 				= VendedoresDados::where('id_user', $id_user)->first();
		//$dadosCliente 			= ClientesIndicacoes::where('id_user', $id_user)->get();
		// $orcamentosCliente 	= DB::table('orcamentos_indicados')
		// 					->where('id_user', '=', $id_user)
		// 					->where('pagamentoComicao', '=', 0)
		// 					->get();

		$idUserSistema 				= $dadosVendedor->id_parceiro_sistema;

		$orcamentosCliente 			= Orcamentos::todosOrcamentosParceiro($idUserSistema);

		//dd($orcamentosCliente);

		$dadosCliente 		= '';

		$arrayOrcamentos	= array();

		//Inicia pacote para enviar dados para API
		$client = new \GuzzleHttp\Client();

		if(!empty($orcamentosCliente)){

			foreach ($orcamentosCliente as $orcamento) { 

				$r = $client->get('https://api.eficazsystem.com.br/api/orcamentoClienteDetalhado/'.$orcamento['Workflow_ID']
					);

				$statusRequisicao 	= $r->getStatusCode();
				$resultado			= $r->json();

				switch ($statusRequisicao) {

					case '200':

						if( !empty($resultado)){


							//dd($resultado);

							// $dateTemp = $resultado['Data_Finalizado'];

							// $data  	  = explode(' ',$dateTemp);

							// $resultado['Data_Finalizado'] = implode('/', array_reverse(explode('-', $data[0])));
 							
 							//Exibe apenas o total da comissão a ser pago pelo orcamento
							//$resultado['totalServico'] = Orcamentos::comissaoOrcamentoAulso($resultado['totalServico']);


							//Adiciona o número de dias para calcular a data de faturamento
							//$dateTemp = date($resultado['Data_Finalizado'], strtotime("+".$resultado['Dias_Vencimento']." days"));

							//$dateTemp = strtotime(date("Y-m-d H:i:s", strtotime()) . " +".$resultado['Dias_Vencimento']."days");


							$diasParaFaturarTemp 	= $resultado[0]['Dias_Vencimento'];
							$dataFinalizado 		= '';
							$totalOrcamento 		= 0;


							//Foreach para somar o resultado de cadas proposta
							foreach ($resultado as $proposta) { 
								
								//Condição para alterar o número de dias para faturar

								if($proposta['Dias_Vencimento'] > $diasParaFaturarTemp){

									$diasParaFaturarTemp = $proposta['Dias_Vencimento'];
								}

								$dataFinalizado 		= $proposta['Data_Finalizado'];

								$totalOrcamento			= $totalOrcamento + $proposta['Valor_Vencimento'];

								$resultado['Titulo'] 	= $proposta['Orc_titulo'];

								$resultado['Status'] 	= $proposta['Status'];

							}

							//Data de faturamento mais cinco dias para pagar o parceiro após o recebimento do faturamento do cliente.

							$diasParaFaturar = $diasParaFaturarTemp + 5;

							$dateTemp = strtotime($dataFinalizado." +".$diasParaFaturar."days");

						    //$date = strtotime($dateTemp);
    						$date = date("l", $dateTemp);

    						switch ($date) {
    							case 'Saturday':
    								$diasParaFaturar = $diasParaFaturar + 2;

						        	$dateTemp = strtotime($dataFinalizado." +".$diasParaFaturar."days");


						        	$resultado['Data_Faturamento'] = date("Y-m-d H:i:s", $dateTemp);

    							break;

    							case 'Sunday':
    								
    								$diasParaFaturar = $diasParaFaturar + 1;

						        	$dateTemp = strtotime($dataFinalizado." +".$diasParaFaturar."days");

						        	$resultado['Data_Faturamento'] = date("Y-m-d H:i:s", $dateTemp);

    							break;
    							
    							default:
    								
    								$resultado['Data_Faturamento'] = date("Y-m-d H:i:s", $dateTemp);

    							break;
    						}

						    
    						$dateTempFatramento 	= $dataFinalizado;
    						$dateTempPagamento 		= $resultado['Data_Faturamento'];


							$data 		= explode(' ',$dateTempFatramento);
							$dataPag 	= explode(' ',$dateTempPagamento);

							$resultado['Data_Finalizado'] 	= implode('/', array_reverse(explode('-', $data[0])));
							$resultado['Data_Faturamento'] 	= implode('/', array_reverse(explode('-', $dataPag[0])));

							// calculo da comissão
							$resultado['Valor_Vencimento'] 	= Orcamentos::comissaoOrcamentoAulso($totalOrcamento);
							$resultado['totalServico'] 		= Orcamentos::comissaoOrcamentoAulso($totalOrcamento);

							// Verifica se já chegou a data de pagar o orçamento ao parceiro

							//dd($resultado);

							$hoje = date('Y-m-d H:i:s');
						   	
						    if($hoje > $dateTempPagamento){

						    	array_push($arrayOrcamentos ,$resultado);

							}

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

	/**
	 * Envia email de solicitação de pagamento de comissao
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function solicitarPagamentoComissao()
	{

		$id_user 			= Session::get('id_atual');
		$status_usuario 	= Session::get('status');
		$dadosVendedor 		= VendedoresDados::where('id_user', $id_user)->first();

		$dadosCliente 		= ClientesIndicacoes::where('id_user', $id_user)->get();
		$orcamentosCliente 	= DB::table('orcamentos_indicados')
							->where('id_user', '=', $id_user)
							->where('pagamentoComicao', '=', 0)
							->get();

		$dadosFinanceiros	=VendedoresFinancas::where('id_user', '=', $id_user)->first();

		// $dadosFinanceiros 	= DB::table('vendedores_finaceiros')  
		// 					->where('id_user', '=', $id_user)
		// 					->get();
		$dadosFinanceiros	=	DB::table('vendedores_finaceiros')
					            ->join('tipo_conta_banco as tpc', 'tpc.id_tipo_conta', '=', 'vendedores_finaceiros.tipo_conta')
					            ->join('instituicao_bancaria as instB', 'instB.id_instituicao_bancaria', '=', 'vendedores_finaceiros.instituicao')
					            ->select(
					            	'vendedores_finaceiros.nome_conta', 
					            	'vendedores_finaceiros.agencia', 
					            	'vendedores_finaceiros.numero_conta',
					            	'tpc.tipo_conta',
					            	'instB.nome_instituicao_bancaria'
					            )
					            ->where('vendedores_finaceiros.id_user', '=', $id_user)
					            ->where('vendedores_finaceiros.deleted_at', '=', null)
					            ->get();

		//Inicia pacote para enviar dados para API
		$client = new \GuzzleHttp\Client();

		if(!empty($orcamentosCliente)){

			$arrayOrcamentos	= array();

			foreach ($orcamentosCliente as $orcamento) {

				$r = $client->get('https://api.eficazsystem.com.br/api/orcamentoClienteDetalhado/'.$orcamento->id_orcamento_sistema
					);

				$statusRequisicao 	= $r->getStatusCode();
				$resultado			= $r->json();

				switch ($statusRequisicao) {

					case '200':

						if( !empty($resultado)){

							$diasParaFaturar = $resultado['Dias_Vencimento'] + 5;

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

    						$dateTempFatramento 	= $resultado['Data_Finalizado'];
    						$dateTempPagamento 		= $resultado['Data_Faturamento'];

							$data 		= explode(' ',$dateTempFatramento);
							$dataPag 	= explode(' ',$dateTempPagamento);

							$resultado['Data_Finalizado'] 	= implode('/', array_reverse(explode('-', $data[0])));
							$resultado['Data_Faturamento'] 	= implode('/', array_reverse(explode('-', $dataPag[0])));

							// calculo da comissão
							$resultado['Valor_Vencimento'] 	= Orcamentos::comissaoOrcamentoAulso($resultado['Valor_Vencimento']);
							$resultado['totalServico'] 		= Orcamentos::comissaoOrcamentoAulso($resultado['totalServico']);

							// Verifica se já chegou a data de pagar o orçamento ao parceiro

							$hoje = date('Y-m-d H:i:s');
						   	
						   	if($hoje > $dateTempPagamento){

						     	array_push($arrayOrcamentos ,$resultado);

						   	}

						}

					break;

					case '404':
						echo 'Falha ao encontrar.';
					break;

					default:
						echo 'Falha ao encontrar.';
					break;

				}

				// Envia email para o setor responsavel pelo pagamento para efetuar o pagamento do parceiro
				// switch ($status_usuario) {
				// 	case 'Admin':
							
				// 		return View::make('clienteIndicado.telefones', $dados);

				// 	break;
						
				// 	case 'Parceiros':
						
				// 		return View::make('orcamentos.parceiro_orcamentos_comicoes', $dados);

				// 	break;

				// 	case 'Cliente':
				// 		# code...
				// 	break;
				// }

			}

			// dd($arrayOrcamentos);

			$dados = array(
				'dadosVendedor' => $dadosVendedor,
				'financeiro' 	=> $dadosFinanceiros,
				'dadosCliente' 	=> $dadosCliente,
				'orcamentos' 	=> $arrayOrcamentos,
				'nomeUsuario'	=> $dadosVendedor->nome_vendedor,
				'solicitacao'   => ''
			);


			//dd($dadosVendedor->nome_vendedor);

			$nome_vendedor = $dadosVendedor->nome_vendedor;

			//Teste de envio de email para parceiro recem cadastrado
			//Utilizando use para que a variavel $nome_vendedor possa ser utilizado
			Mail::send('emails.solicitacao_pagamento', $dados, function($message) use ($nome_vendedor)
			{

				//
				$message->to('sistemaeficaz@sistema.eficazsystem.com.br', $nome_vendedor)
						->from('noreply@sistema.eficazsystem.com.br')
	          			->subject('Solicitação de pagamento de comissão ,'. $nome_vendedor .' !');
	          				
			});

			//return Redirect::back()->withInput(array( 'solicitacao' => 'Solicitação efetuada com sucesso!'));
			$dados['solicitacao'] = 'Solicitação efetuada com sucesso!';


			return View::make( 'orcamentos.parceiro_orcamentos_comicoes', $dados);

			// dd($arrayOrcamentos);

			// die();
		}else{

			$dados['solicitacao'] = 'Nenhum orçamento completado para efetuar pagamento!';

			return View::make( 'orcamentos.parceiro_orcamentos_comicoes', $dados);

			//return Redirect::back()->withInput(array( 'solicitacao' => 'Nenhum orçamento completado para efetuar pagamento!'));

		}

	}



	/**
	 * Carrega a tela de registro de pagamento da comissão.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function marcarComoPago_desativado($id){

		$arrayOrcamentos	= array();
		$parceiroPago 		= '';

		//Carrega dados do orçamento
		$orcamentosCliente 	= DB::table('orcamentos_indicados')
							->where('id_orcamento_sistema', '=', $id)
							->where('pagamentoComicao', '=', 0)
							->where('deleted_at', '=', null)
							->get();

		if(! empty($orcamentosCliente)){
			$parceiroPago 	= DB::table('usersEficazTable')
							->where('id', '=', $orcamentosCliente[0]->id_user)
							->get();
		}

		//Carregar os detalhes do orçamento

		if(! empty($orcamentosCliente)){

			//Inicia pacote para enviar dados para API
			$client = new \GuzzleHttp\Client();

			$r = $client->get('https://api.eficazsystem.com.br/api/orcamentoClienteDetalhado/'.$orcamentosCliente[0]->id_orcamento_sistema
					);

			$statusRequisicao 	= $r->getStatusCode();
			$resultado			= $r->json();


			switch ($statusRequisicao) {

				case '200':

					if( !empty($resultado)){

						$diasParaFaturar = $resultado['Dias_Vencimento'] + 5;

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

	    				$dateTempFatramento 			= $resultado['Data_Finalizado'];
	    				$dateTempPagamento 				= $resultado['Data_Faturamento'];

						$data 							= explode(' ',$dateTempFatramento);
						$dataPag 						= explode(' ',$dateTempPagamento);

						$resultado['Data_Finalizado'] 	= implode('/', array_reverse(explode('-', $data[0])));
						$resultado['Data_Faturamento'] 	= implode('/', array_reverse(explode('-', $dataPag[0])));

						// calculo da comissão
						$resultado['Valor_Vencimento'] 	= Orcamentos::comissaoOrcamentoAulso($resultado['Valor_Vencimento']);
						$resultado['totalServico'] 		= Orcamentos::comissaoOrcamentoAulso($resultado['totalServico']);

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

		// dd($arrayOrcamentos);

		$dados 			= [
			'orcamentos' 	=> $arrayOrcamentos,
			'parceiro'		=> $parceiroPago
		];

		// Carrega a tela para pagar o parceiro

		return View::make( 'orcamentos.parceiro_registrar_pagamento_comicoes', $dados);

	}

	/**
	 * Carrega a tela de registro de pagamento da comissão.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function marcarComoPago($id){

		if(is_numeric($id)){


			//Carrega os dados da proposta que será marcada como paga.

			$propostaOrcamento = Orcamentos::orcamentoProposta($id);

			dd($propostaOrcamento);

			if( !empty($propostaOrcamento)){



				//return View::make('orcamentos.orcamentos_proposta');

			}else{

				return View::make( 'error.index');

			}


		}else{

			return View::make( 'error.index');

		}

	}

	/**
	 * Carrega a tela de registro de pagamento da comissão.
	 *
	 * @return Response
	 */
	public function gardar_pgmt(){


		$vendedor_pagamento  = new VendedoresPagamentos();


		if( ! $vendedor_pagamento->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($vendedor_pagamento->errors);

		}else{

			//$orcamento 	 	= 	new Orcamentos();

			$orcamentoPago  =	DB::table('orcamentos_indicados')
								->where('id_orcamento_sistema', '=', Input::get('id_orcamento'))
								->where('pagamentoComicao', '=', 0)
								->where('deleted_at', '=', null)
								->first();

			

			$orcamento 		= Orcamentos::find($orcamentoPago->id_orcamento);

			//dd($orcamento);

			//find(Input::get('id_orcamento'));

			//dd($orcamentoPago);

			$orcamento->pagamentoComicao		= 1;
			$orcamento->save();

			$vendedor_pagamento->id_orcamento 		= Input::get('id_orcamento');
			$vendedor_pagamento->id_user 			= Input::get('id_usuario');
			$vendedor_pagamento->observacao_pgmt 	= Input::get('observacao_pgmt');


			$vendedor_pagamento->save();


			$dados 			= [
				'orcamentoId' 	=> Input::get('id_orcamento')
			];

			
			return View::make( 'orcamentos.parceiro_pagamento_efetuado', $dados);
		}

	}

}
