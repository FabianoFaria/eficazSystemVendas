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

			$user 			= User::find($id_user);

			//$json 			= json_decode(file_get_contents('http://127.0.0.1/apiEficaz/public/api/contatos'), true);

			//dd($dadosVendedor);

			// $usuario_atual 	= Auth::user()->nome_usuario;
			// $id_atual 		= Auth::user()->id;
			// $status 		= Auth::user()->status;

			//return View::make('greeting', array('name' => 'Taylor'));

			//Usuário logado
			//return View::make('admin.index', array( 'nome_usuario' => $usuario_atual, 'id' => $id_atual, 'status' => $status));

			//Verifica para qual tela de administração será redirecionada o admin
			switch ($status_usuario) {
				case 'Admin':
					
					return View::make('admin.index', [
					'dadosVendedor' => $dadosVendedor, 
					'statusUsuario' => $status_usuario,
					'enderecos' => $dadosEndereco,
					'telefones' => $dadosContatos
					]);

				break;
				
				case 'Parceiros':
					
					return View::make('parceiros.index', [
					'dadosVendedor' => $dadosVendedor, 
					'statusUsuario' => $status_usuario,
					'enderecos' => $dadosEndereco,
					'telefones' => $dadosContatos
					]);

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
