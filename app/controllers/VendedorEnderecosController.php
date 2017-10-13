<?php

class VendedorEnderecosController extends \BaseController {


	public function __construct(VendedoresEnderecos $vendedorEndereco) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->vendedorEndereco = $vendedorEndereco;
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
		$dadosEndereco  = VendedoresEnderecos::where('id_user', $id_user)->get();
		//$dadosEndereco = DB::table('vendedores_enderecos')->where('id_user', '=', $id_user)->get();

		//dd($dadosEndereco);

		// $dadosEndereco 	= DB::table('vendedores_enderecos')->where(function ($query) {
		//     $query->where('id_user', Session::get('id_atual'))
		//         ->where('status_endereco', '>', 0);
		// });

		//dd($dadosEndereco);


		$estados 		= EstadosPais::all();
		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'enderecos' => $dadosEndereco,
			'estados' 	=> $estados,
		];

		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'enderecos.index', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'enderecos.parceiros_enderecos', $dados);

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
					'estados' 	=> $estados,
				];

		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
					
				return View::make('enderecos.create', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make('enderecos.parceiros_create', $dados);

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
		if( ! $this->vendedorEndereco->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->vendedorEndereco->errors);

		}else{

			$this->vendedorEndereco->id_user 		= Input::get('id_usuario');
			$this->vendedorEndereco->cep_endereco 	= Input::get('cep');
			$this->vendedorEndereco->logradouro		= Input::get('logradouro');
			$this->vendedorEndereco->numero 		= Input::get('numero');
			$this->vendedorEndereco->complemento 	= Input::get('complemento');
			$this->vendedorEndereco->bairro 		= Input::get('bairro');
			$this->vendedorEndereco->cidade 		= Input::get('cidade');
			$this->vendedorEndereco->uf 			= Input::get('estado_endereco');
			$this->vendedorEndereco->status_endereco = 1;

			$this->vendedorEndereco->save();

			return Redirect::route('enderecos.index');

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
		$id_user 		= $id;
		$status_usuario = Session::get('status');
		$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		$dadosEndereco  = VendedoresEnderecos::where('id_user', $id_user)->get();

		$estados 		= EstadosPais::all();
		$dados 			= [
			'dadosVendedor' => $dadosVendedor, 
			'enderecos' => $dadosEndereco,
			'estados' 	=> $estados,
		];

		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
					
				return View::make( 'enderecos.index', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'enderecos.parceiros_enderecos', $dados);

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
		$id_user 		= Session::get('id_atual');
		$status_usuario = Session::get('status');
		$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		$dadosEndereco  = VendedoresEnderecos::find($id); 
		$estados 		= EstadosPais::all();

		$dados 			= [
				'dadosVendedor' => $dadosVendedor, 
				'enderecos' 	=> $dadosEndereco,
				'estados' 		=> $estados,
		];


		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
					
				return View::make('enderecos.edit', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make('enderecos.parceiros_edit', $dados);

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

		$id_endereco = Input::get('id_endereco');

		$this->vendedorEndereco = VendedoresEnderecos::find($id_endereco);

		//
		if( ! $this->vendedorEndereco->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->vendedorEndereco->errors);

		}else{

			$this->vendedorEndereco->cep_endereco 	= Input::get('cep');
			$this->vendedorEndereco->logradouro		= Input::get('logradouro');
			$this->vendedorEndereco->numero 		= Input::get('numero');
			$this->vendedorEndereco->complemento 	= Input::get('complemento');
			$this->vendedorEndereco->bairro 		= Input::get('bairro');
			$this->vendedorEndereco->cidade 		= Input::get('cidade');
			$this->vendedorEndereco->uf 			= Input::get('estado_endereco');
			$this->vendedorEndereco->status_endereco = 1;

			$this->vendedorEndereco->save();

			return Redirect::route('enderecos.index');

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
		$endereco = VendedoresEnderecos::find($id);

		$endereco->status_endereco = 0;
		$endereco->delete();

		return Redirect::route('enderecos.index');

	}


}
