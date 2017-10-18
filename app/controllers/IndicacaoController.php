<?php

use \GuzzleHttp\Exception\RequestException;

class IndicacaoController extends \BaseController {

	public function __construct(ClientesIndicacoes $ClientesIndicacoes) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->clienteIndicacao = $ClientesIndicacoes;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$id_user 		= Session::get('id_atual');
		$status_usuario = Session::get('status');
		$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		$dadosClientes	= ClientesIndicacoes::where('id_user', $id_user)->get();


		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'clientes' 		=> $dadosClientes,
		];

		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.index', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'clienteIndicado.parceiros_clientes', $dados);

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
		$id_user 		= Session::get('id_atual');
		$status_usuario = Session::get('status');
		$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		$estados 		= EstadosPais::all();

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'estados' 		=> $estados,
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.create', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'clienteIndicado.parceiros_create', $dados);

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

		if( ! $this->clienteIndicacao->isValid($input = Input::all())){


			return Redirect::back()->withInput()->withErrors($this->clienteIndicacao->errors);

		}else{

			$this->clienteIndicacao->id_user = Input::get('id_usuario');
			$this->clienteIndicacao->nome_completo = Input::get('nome_completo');
			$this->clienteIndicacao->nome_fantasia_cliente = Input::get('nome_fantasia');
			$this->clienteIndicacao->email_cliente = Input::get('email_cliente');
			$this->clienteIndicacao->cpf_cnpj = Input::get('cpf_cnpj');

			$data_nascimento_criacao = implode('-', array_reverse(explode('/', Input::get('data_nascimento_criacao'))));

			$this->clienteIndicacao->data_nascimento = $data_nascimento_criacao;

			if (Input::hasFile('imagem_documento'))
			{
			    $file = Input::file('imagem_documento');
			    //$file->move('img/uploads/imagens_documentos', $file->getClientOriginalName());

			    //$img = Image::make(Input::file('imagem_documento')->getRealPath());

			    $nomeImagem = Hash::Make($file->getClientOriginalName());
			    $filename  = time() . '.' . $file->getClientOriginalExtension();

			    $path = public_path('img/uploads/imagens_documentos/' . $filename);

			    //dd($nomeImagem);

			    $image = Image::make(Input::file('imagem_documento'))->resize(200, 200)->save($path);

			    $this->clienteIndicacao->cliente_imagem_documento = $filename;

			}

			//SALVA O CLIENTE NO BANCO DE DADOS DO SISTEMA DE VENDAS
			//$this->clienteIndicacao->save();
			//EFETUA O ENVIO DE DADOS PARA A API DA EFICAZ

			//use GuzzleHttp\Client;

			//$client = new Client;

			//Inicia pacote para enviar dados para API
			$client 			= new \GuzzleHttp\Client();


			try {

			   $r = $client->post('https://api.eficazsystem.com.br/api/criarContato', 
                ['json' => [
                    "Nome" 				=>	Input::get('nome_completo'),
                    "Nome_Fantasia" 	=> 	Input::get('nome_fantasia'),
                    "Email"				=>	Input::get('email_cliente'),
                    "Cpf_Cnpj"			=>	Input::get('cpf_cnpj'),
                    "Data_Nascimento"	=>	$data_nascimento_criacao
                ]]);

			    // Here the code for successful request

			} catch (RequestException $e) {

			    // Catch all 4XX errors 

			    // To catch exactly error 400 use 
			    if ($e->getResponse()->getStatusCode() == '400') {
			        //echo "Got response 400";
			        Session::flash('error_cad', 'Não foi possivel cadastrar, verifique os dados informados e tente novamente.');

					return Redirect::back()->withInput();
			    }

			    // You can check for whatever error status code you need 

			}



			// $r = $client->post('https://api.eficazsystem.com.br/api/criarContato', 
			// $r = $client->post('https://api.eficazsystem.com.br/api/criarContato', 
   //              ['json' => [
   //                  "Nome" 				=>	Input::get('nome_completo'),
   //                  "Nome_Fantasia" 	=> 	Input::get('nome_fantasia'),
   //                  "Email"				=>	Input::get('email_cliente'),
   //                  "Cpf_Cnpj"			=>	Input::get('cpf_cnpj'),
   //                  "Data_Nascimento"	=>	$data_nascimento_criacao
   //              ]]);

			$statusRequisicao 	= $r->getStatusCode();
			$resultado			= $r->json();
			// $contantType 		= $r->getHeader('Content-Length');
			// $reason 			= $r->getReasonPhrase(); // OK

			switch ($statusRequisicao) {
				case '201':

					# Cadastro foi efetuado com sucesso
					# Cliente será salvo no cadastro do parceiro
					$this->clienteIndicacao->id_cliente_sistema_eficaz = $resultado['Cadastro_ID'];

					$this->clienteIndicacao->save();

					return Redirect::route('indicacoes.index');

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

			//Verificar o status da requisição e então 

			
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
		$id_user 		= Session::get('id_atual');
		$status_usuario = Session::get('status');
		$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		$dadosCliente 	= ClientesIndicacoes::find($id);
		$data_nascimento_criacao = implode('/', array_reverse(explode('-', $dadosCliente->data_nascimento)));

		//dd($dadosCliente->data_nascimento);

		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'cliente' 		=> $dadosCliente,
			'data_nascimento_criacao' => $data_nascimento_criacao,
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'clienteIndicado.edit', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'clienteIndicado.parceiros_edit', $dados);

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
		 $rules = array(
            'nome_completo'       		=> 'required',
            'email_cliente'      		=> 'required|email',
           	'data_nascimento_criacao' 	=> 'required|date_format:d/m/Y',
    		'cpf_cnpj' 					=> 'required|cpfCnpj',
        );

		$validator = Validator::make(Input::all(), $rules);

		if( $validator->fails()){

			return Redirect::back()->withInput()->withErrors($this->clienteIndicacao->errors);

		}else{

			$this->clienteIndicacao = ClientesIndicacoes::find(Input::get('id_indicacao'));
			//$this->clienteIndicacao->id_user = Input::get('id_usuario');
			$this->clienteIndicacao->nome_completo = Input::get('nome_completo');
			$this->clienteIndicacao->nome_fantasia_cliente = Input::get('nome_fantasia');
			$this->clienteIndicacao->email_cliente = Input::get('email_cliente');
			$this->clienteIndicacao->cpf_cnpj = Input::get('cpf_cnpj');

			$data_nascimento_criacao = implode('-', array_reverse(explode('/', Input::get('data_nascimento_criacao'))));

			if (Input::hasFile('imagem_documento'))
			{
				$file = Input::file('imagem_documento');

				$nomeImagem = Hash::Make($file->getClientOriginalName());
			    $filename  	= time() . '.' . $file->getClientOriginalExtension();

			    $path = public_path('img/uploads/imagens_documentos/' . $filename);

			    $image = Image::make(Input::file('imagem_documento'))->resize(200, 200)->save($path);


			    //remover o arquivo antigo
			    $imagemAntiga = Input::get('imagem_antiga');

			    if($imagemAntiga != ''){

			    	File::delete('img/uploads/imagens_documentos/' . $imagemAntiga);

			    }

			    $this->clienteIndicacao->cliente_imagem_documento = $filename;
			}

			#Envio para edição via API
			$client = new \GuzzleHttp\Client(); 

			// $r = $client->put('https://api.eficazsystem.com.br/api/editarContato/'.Input::get('id_cliente_sistema_eficaz'.''), 
			$r = $client->put('https://api.eficazsystem.com.br/api/editarContato/'.Input::get('id_cliente_sistema_eficaz'.''), 
                ['json' => [
                	"Cadastro_ID" 		=> Input::get('id_cliente_sistema_eficaz'),
                    "Nome" 				=>	Input::get('nome_completo'),
                    "Nome_Fantasia" 	=> 	Input::get('nome_fantasia'),
                    "Email"				=>	Input::get('email_cliente'),
                    "Cpf_Cnpj"			=>	Input::get('cpf_cnpj'),
                    "Data_Nascimento"	=>	$data_nascimento_criacao
                ]]);

			$statusRequisicao 	= $r->getStatusCode();
			$resultado			= $r->json();

			switch ($statusRequisicao) {
				case '201':

					# Update foi efetuado com sucesso

					$this->clienteIndicacao->save();

					return Redirect::route('indicacoes.index');

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

			// $this->clienteIndicacao->save();

			// return Redirect::route('indicacoes.index');
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
	}


}
