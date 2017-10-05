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
			$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
			$dadosEndereco  = VendedoresEnderecos::where('id_user', $id_user)->first();
			$dadosContatos  = VendedoresTelefones::where('id_user', $id_user)->first();
			$dadosFinaceiro = VendedoresFinancas::where('id_user', $id_user)->first();

			$user 			= User::find($id_user);

			//$json 			= json_decode(file_get_contents('http://127.0.0.1/apiEficaz/public/api/contatos'), true);

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
					
					$faturarIndicacoes = 0.00;
					$totalOrcamentos = Orcamentos::quantidadeOrcamentoUsuario($id_user);
					$totalIndicacoes = ClientesIndicacoes::quantidadeIndicadosUsuario($id_user);

				break;
				
				case 'Parceiros':
					
					$indicacoesOrcamentos 	= Orcamentos::orcamentosIndicados($id_user);
					$totalOrcamentos 		= Orcamentos::quantidadeOrcamentoUsuario($id_user);
					$totalIndicacoes 		= ClientesIndicacoes::quantidadeIndicadosUsuario($id_user);

					$faturarIndicacoes 		= '';

					if(!empty($indicacoesOrcamentos)){

						//dd($indicacoesOrcamentos);

						$arrayOrcamentos	= array();

						//Inicia pacote para enviar dados para API
						$client = new \GuzzleHttp\Client();


						foreach ($indicacoesOrcamentos as $orcamento) { 

							$r = $client->get('http://127.0.0.1/apiEficaz/public/api/orcamentoClienteDetalhado/'.$orcamento->id_orcamento_sistema);

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

								case '404':
									echo 'Falha ao encontrar.';
								break;

								default:
									echo 'Falha ao encontrar.';
								break;

							}

						}

						// var_dump($arrayOrcamentos);

						// die();

						if(!empty($arrayOrcamentos)){

							$faturarIndicacoes == '1,00';

						}else{
							$faturarIndicacoes == 0.00;
						}
					}else{

						$faturarIndicacoes 		= 0.00;

					}

				break;

			}


			$dados = [
				'dadosVendedor' => $dadosVendedor, 
				'statusUsuario' => $status_usuario,
				'enderecos' => $dadosEndereco,
				'telefones' => $dadosContatos,
				'financeiro' => $dadosFinaceiro,
				'indicacoes' => $totalIndicacoes[0]->indicados,
				'totalOrcamentos' => $totalOrcamentos[0]->orcamentos,
				'faturar'	=> $faturarIndicacoes
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
