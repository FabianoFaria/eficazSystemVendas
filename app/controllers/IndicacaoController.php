<?php

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
			$this->clienteIndicacao->data_nascimento = Input::get('data_nascimento');
			$this->clienteIndicacao->cpf_cnpj = Input::get('cpf_cnpj');

			if (Input::hasFile('imagem_documento'))
			{
			    $file = Input::file('imagem_documento');
			    $file->move('img/uploads/imagens_documentos', $file->getClientOriginalName());

			    //$img = Image::make(Input::file('imagem_documento')->getRealPath());


			    $nomeImagem = Hash::Make($file->getClientOriginalName());

			    //dd($nomeImagem);

			    $image = Image::make(sprintf('img/uploads/imagens_documentos/%s', $file->getClientOriginalName()) )->resize(200, 200)->save('img/uploads/imagens_documento/'.$nomeImagem.'jpg');

			    //dd($nomeImagem);

			    //$image = Image::make(Input::file('imagem_documento')->getRealPath())->resize(120,75);

			    // $image = Image::make(sprintf('img/uploads/imagens_documentos/%s', Input::file('imagem_documento')->getRealPath() )->resize(200, 200)->save('public/img/uploads/imagens_documento/'.$nomeImagem.'.jpg');

			    $this->clienteIndicacao->cliente_imagem_documento = $nomeImagem.'.png';

			}


			//$this->clienteIndicacao->save();

			return Redirect::route('indicacoes.index');
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
