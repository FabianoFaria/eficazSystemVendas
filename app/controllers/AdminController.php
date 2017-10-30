<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//

		if(Auth::check()){

			$id_user 		= Session::get('id_atual');
			$status_usuario = Session::get('status');
			$user 			= User::find($id_user);

			//$json 			= json_decode(file_get_contents('https://api.eficazsystem.com.br/api/contatos'), true);

			//dd($dadosVendedor);

			// $usuario_atual 	= Auth::user()->nome_usuario;
			// $id_atual 		= Auth::user()->id;
			// $status 		= Auth::user()->status;

			//return View::make('greeting', array('name' => 'Taylor'));

			//Usuário logado
			//return View::make('admin.index', array( 'nome_usuario' => $usuario_atual, 'id' => $id_atual, 'status' => $status));

			// Carrega dados referentes ao total em indicações e o total de indicados



			switch ($status_usuario) {

				case 'Admin':
					
					// $faturarIndicacoes = 0.00;
					// $totalOrcamentos = Orcamentos::quantidadeOrcamentoUsuario($id_user);
					// $totalIndicacoes = ClientesIndicacoes::quantidadeIndicadosUsuario($id_user);

				break;
				
				case 'Parceiros':

					$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
					$dadosEndereco  = VendedoresEnderecos::where('id_user', $id_user)->first();
					$dadosContatos  = VendedoresTelefones::where('id_user', $id_user)->first();
					$dadosFinaceiro = VendedoresFinancas::where('id_user', $id_user)->first();

					if(!empty($dadosVendedor)){

						$idUserSistema 				= $dadosVendedor->id_parceiro_sistema;

						$indicacoesOrcamentos		= Orcamentos::todosOrcamentosParceiro($idUserSistema);
						$totalComissoesOrcamentos	= Orcamentos::quantidadeOrcamentoUsuario($idUserSistema);
						$totalIndicados				= ClientesIndicacoes::quantidadeIndicadosUsuario($idUserSistema);

						$totalOrcamentosAbertos 	= count($totalComissoesOrcamentos);

					}else{

						$idSistema 					= '';

						$indicacoesOrcamentos		= null;
						$totalComissoesOrcamentos	= 0;
						$totalIndicados				= 0;
						$totalOrcamentosAbertos 	= 0;
					}	

					//dd($indicacoesOrcamentos);
					
					//$indicacoesOrcamentos 	= Orcamentos::orcamentosIndicados($id_user);
					//$totalOrcamentos 		= Orcamentos::quantidadeOrcamentoUsuario($id_user);
					//$totalIndicacoes 		= ClientesIndicacoes::quantidadeIndicadosUsuario($id_user);

					$faturarIndicacoes 		= '';

					/*
					// Com a lista de orçamentos e busca as propostas e os valores a serem cobrados do cliente
					// Contabiliza o total para pagar em comissões
					*/

					if(!empty($indicacoesOrcamentos)){

						$faturarIndicacoes 	= 0;

						$arrayOrcamentos	= array();

						//Inicia pacote para enviar dados para API
						$client = new \GuzzleHttp\Client();

						foreach ($indicacoesOrcamentos as $orcamento) { 

							$r = $client->get('https://api.eficazsystem.com.br/api/orcamentoClienteDetalhado/'.$orcamento['Workflow_ID']);

							$statusRequisicao 	= $r->getStatusCode();
							$resultado			= $r->json();

							switch ($statusRequisicao) {

								case '200':

									if( !empty($resultado)){


										//Dias para vencer prazo de faturamento do orçamento para o cliente

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

			    						///////
			    						
    									$dateTempPagamento 		= $resultado['Data_Faturamento'];

    									$hoje = date('Y-m-d H:i:s');
						   	
									   	if($hoje > $dateTempPagamento){

									   		array_push($arrayOrcamentos ,$resultado);

									   	}

										//dd($resultado);
										//var_dump($resultado);
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

						//Após recuperar os dados dos orçamentos, retirar os valores
						// cobrados nos orçamentos.
						//Orcamentos::comissaoOrcamentoAulso();

						if(!empty($arrayOrcamentos)){

							foreach ($arrayOrcamentos as $orcamentosFechados) {
								
								//dd($orcamentosFechados);

								$valorOrcamento    = $orcamentosFechados['totalServico'];

								$faturarIndicacoes = $faturarIndicacoes + Orcamentos::comissaoOrcamentoAulso($valorOrcamento);
							}

						}else{

							$faturarIndicacoes 		= 0;
						}

					}else{

						$faturarIndicacoes 		= 0;

					}

					$faturarIndicacoes = number_format($faturarIndicacoes, 2, ',', '');

				break;

			}

			//dd($totalOrcamentosAbertos);

			$dados = [
				'dadosVendedor' 	=> $dadosVendedor, 
				'statusUsuario' 	=> $status_usuario,
				'enderecos' 		=> $dadosEndereco,
				'telefones' 		=> $dadosContatos,
				'financeiro' 		=> $dadosFinaceiro,
				'indicacoes' 		=> $totalIndicados,
				'totalOrcamentos' 	=> $totalOrcamentosAbertos,
				'faturar'			=> $faturarIndicacoes
			];

			//Verifica para qual tela de administração será redirecionada o admin
			switch ($status_usuario) {
				case 'Admin':
					
					return View::make('admin.index', $dados);

				break;
				
				case 'Parceiros':
					
					return View::make('parceiros.index', $dados);

				break;

				case 'Cliente':
					# code...
				break;
			}
			

		}else{
			
			return Redirect::to('/');

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
		return Redirect::to('/');
	}


}
