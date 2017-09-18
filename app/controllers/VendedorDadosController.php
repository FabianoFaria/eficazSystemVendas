<?php

class VendedorDadosController extends \BaseController {

	public function __construct(VendedoresDados $vendedor) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->vendedor = $vendedor;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//

		if( ! $this->vendedor->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->vendedor->errors);

		}else{

			$this->vendedor->id_user = Input::get('id_usuario');
			$this->vendedor->nome_vendedor = Input::get('nomeCompleto');
			$this->vendedor->nome_fantasia = Input::get('nomeFantasia');
			$this->vendedor->cnpj_cpf = Input::get('cpfCnpj');
			$this->vendedor->rg_vendedor = Input::get('rgVendedor');
			$this->vendedor->genero = Input::get('generoVendedor');
			$this->vendedor->foto = 'default.png';

			$this->vendedor->save();

			return Redirect::route('admin.index');
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
		return 'teste';
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
		$vendedor 			= VendedoresDados::where('id_user', $id)->first();

		//Status do usuario logado...
		$status_usuario = Session::get('status');

		$dados 			= [
			'vendedor' => $vendedor,
		];


		//dd($vendedor);
	
		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
					
				//retorna a view com os dados necessarios.
				return View::make('admin.editar_parceiro', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'parceiros.parceiros_editar_vendedor', $dados);

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
            'nomeCompleto'       	=> 'required',
            'rgVendedor'			=> 'numeric',
            'cpfCnpj'				=> 'required|alpha_num|cpfCnpj',
        );

		$validator = Validator::make(Input::all(), $rules);

		// process the login
        if ($validator->fails()) {

        	// return Redirect::to('vendedores/' . $id . '/edit')
         //        ->withErrors($validator)
         //        ->withInput(Input::except('senhaUsuario'),Input::except('confirmaSenhaUsuario'));

            return Redirect::back()->withInput()->withErrors($this->vendedor->errors);

        }else{


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
