<?php

class VendedorTelefonesController extends \BaseController {


	public function __construct(VendedoresTelefones $vendedorTelefone) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->VendedoresTelefones = $vendedorTelefone;
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
		$dadosTelefones = VendedoresTelefones::where('id_user', $id_user)->get();

		$estados 		= EstadosPais::all();

		$dados  		= [
				'dadosVendedor' => $dadosVendedor, 
				'telefones' 	=> $dadosTelefones,
				'estados' 		=> $estados,
			];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make('telefones.index', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make('telefones.parceiros_index', $dados);

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

		$dados  		= [
			'dadosVendedor' => $dadosVendedor,
			'estados' 	=> $estados,
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make('telefones.create', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make('telefones.parceiros_create', $dados);

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
		if( ! $this->VendedoresTelefones->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->VendedoresTelefones->errors);

		}else{

			$this->VendedoresTelefones->id_user 				= Input::get('id_usuario');
			$this->VendedoresTelefones->telefone 				= Input::get('telefone');
			$this->VendedoresTelefones->observacacao_telefone 	= Input::get('observacao');
			$this->VendedoresTelefones->status_telefone 		= 1;

			$this->VendedoresTelefones->save();

			return Redirect::route('telefones.index');

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
		$dadosTelefones = VendedoresTelefones::where('id_user', $id_user)->get();

		$estados 		= EstadosPais::all();

		$dados  		= [
				'dadosVendedor' => $dadosVendedor, 
				'telefones' 	=> $dadosTelefones,
				'estados' 		=> $estados,
			];

			//dd($dadosVendedor);

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make('telefones.index', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make('telefones.parceiros_index', $dados);

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
		//$dadosTelefones = VendedoresTelefones::where('id_user', $id_user)->first();
		$dadosTelefones = VendedoresTelefones::find($id);

		//dd($dadosVendedor);

		$dados  		= [
			'dadosVendedor' => $dadosVendedor,
			'telefones' => $dadosTelefones,
		];

		switch ($status_usuario) {
			case 'Admin':
					
				return View::make('telefones.edit', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make('telefones.parceiros_edit', $dados);

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
		$id_telefone = Input::get('id_telefone');

		$this->VendedoresTelefones = VendedoresTelefones::find($id_telefone);

		if( ! $this->VendedoresTelefones->isValid($input = Input::all())){

			return Redirect::back()->withInput()->withErrors($this->VendedoresTelefones->errors);

		}else{

			$this->VendedoresTelefones->telefone 				= Input::get('telefone');
			$this->VendedoresTelefones->observacacao_telefone	= Input::get('observacao');

			$this->VendedoresTelefones->save();
			
			return Redirect::route('telefones.index');
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
		$telefone = VendedoresTelefones::find($id);

		$telefone->status_telefone = 0;
		//$telefone->save();
		$telefone->delete();

		return Redirect::route('telefones.index');
	}


}
