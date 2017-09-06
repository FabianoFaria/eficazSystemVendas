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
		$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		$dadosTelefones = VendedoresTelefones::where('id_user', $id_user)->first();

		$estados 		= EstadosPais::all();

		return View::make('telefones.index', [
				'dadosVendedor' => $dadosVendedor, 
				'telefones' 	=> $dadosTelefones,
				'estados' 		=> $estados,
		]);

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
		$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		$estados 		= EstadosPais::all();

		return View::make('telefones.create', [
			'dadosVendedor' => $dadosVendedor,
			'estados' 	=> $estados,
		]);
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
		$dadosVendedor 	= VendedoresDados::find($id);
		$dadosTelefones = VendedoresTelefones::where('id_user', $id_user)->first();

		return View::make('telefones.edit', [
				'dadosVendedor' => $dadosVendedor, 
				'telefones' => $dadosTelefones,
		]);
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
		$telefone = VendedoresTelefones::find($id);

		$telefone->status_telefone = 0;
		//$telefone->save();
		$endereco->delete();

		return Redirect::route('telefones.index');
	}


}
