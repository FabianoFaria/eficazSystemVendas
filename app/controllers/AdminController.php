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


			$json = json_decode(file_get_contents('http://127.0.0.1/apiEficaz/public/api/contatos'), true);

			//dd($json);

			// $usuario_atual 	= Auth::user()->nome_usuario;
			// $id_atual 		= Auth::user()->id;
			// $status 		= Auth::user()->status;

			//return View::make('greeting', array('name' => 'Taylor'));

			//Usuário logado
			//return View::make('admin.index', array( 'nome_usuario' => $usuario_atual, 'id' => $id_atual, 'status' => $status));
			return View::make('admin.index', ['contatosClientes' => $json]);

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
