<?php

class VendedorFinancasController extends \BaseController {

	public function __construct(VendedoresFinancas $vendedorFinanca) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->VendedoresFinancas = $vendedorFinanca;
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
		$dadosFinancas 	= VendedoresFinancas::where('id_user', $id_user)->first();
		$tipos_conta	= TipoContaBancaria::all();
		$lista_bancos 	= InstituicoesBancarias::all();

		$estados 		= EstadosPais::all();

		return View::make('informacoesBancarias.index', [
				'dadosVendedor' => $dadosVendedor, 
				'contas' 		=> $dadosFinancas,
				'estados' 		=> $estados,
				'tipo_contas'   => $tipos_conta,
				'lista_bancos' 	=> $lista_bancos,
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
		$dadosFinancas 	= VendedoresFinancas::where('id_user', $id_user)->first();
		$tipos_conta	= TipoContaBancaria::all();
		$lista_bancos 	= InstituicoesBancarias::all();

		return View::make('informacoesBancarias.create', [
				'dadosVendedor' => $dadosVendedor, 
				'contas' 		=> $dadosFinancas,
				'tipo_contas'   => $tipos_conta,
				'lista_bancos' 	=> $lista_bancos,
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
		if( ! $this->VendedoresFinancas->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->VendedoresFinancas->errors);

		}else{

			$this->VendedoresFinancas->id_user 			= Input::get('id_usuario');
			$this->VendedoresFinancas->nome_conta 		= Input::get('nomeConta');
			$this->VendedoresFinancas->numero_conta 	= Input::get('numeroConta');
			$this->VendedoresFinancas->instituicao 		= Input::get('instituicao');
			$this->VendedoresFinancas->tipo_conta 		= Input::get('tipoConta');

			$this->VendedoresFinancas->save();

			return Redirect::route('financas.index');

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
		$dadosVendedor 	= VendedoresDados::where('id_user', $id_user)->first();
		$dadosFinancas 	= VendedoresFinancas::find($id);
		$tipos_conta	= TipoContaBancaria::all();
		$lista_bancos 	= InstituicoesBancarias::all();

		return View::make('informacoesBancarias.edit', [
				'dadosVendedor' => $dadosVendedor, 
				'contas' 		=> $dadosFinancas,
				'tipo_contas'   => $tipos_conta,
				'lista_bancos' 	=> $lista_bancos,
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
		$id_conta_vendedor = Input::get('id_conta_vendedor');

		$this->VendedoresFinancas = VendedoresFinancas::find($id_conta_vendedor);

		//
		if( ! $this->VendedoresFinancas->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->VendedoresFinancas->errors);

		}else{

			$this->VendedoresFinancas->nome_conta 		= Input::get('nomeConta');
			$this->VendedoresFinancas->numero_conta 	= Input::get('numeroConta');
			$this->VendedoresFinancas->instituicao 		= Input::get('instituicao');
			$this->VendedoresFinancas->tipo_conta 		= Input::get('tipoConta');

			$this->VendedoresFinancas->save();

			return Redirect::route('financas.index');

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
		$conta = VendedoresFinancas::find($id);
		$conta->delete();

		return Redirect::route('financas.index');
	}


}
