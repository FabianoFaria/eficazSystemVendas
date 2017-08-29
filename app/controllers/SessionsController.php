<?php


	class SessionsController extends BaseController {

		public function __construct(User $user) {

		    $this->user = $user;
		}

		public function create(){

			
			//Verificação de validação
			if(Auth::check()){

				//Usuário logado
				return Redirect::to('/admin');

			}else{
				return View::make('usersEficaz.login');
			}

		}

		public function store(){

			//dd(Input::all());

			//if(Auth::attempt(Input::only('email_usuario','senha_usuario'))){

			$dataAttempt = array(
	            'email_usuario' => Input::get('email_usuario'),
	            'password' => Input::get('senha_usuario')
	        );


			//REFATORANDO O PROCESSO DE LOGIN
			if( ! $this->user->isValidLogin($dataAttempt)){

				//return 'Falha de validação!';
				//return Redirect::back()->withInput()->withErrors($validacao->messages());
				//return Redirect::back()->withInput()->withErrors($this->user->errors);

				//return Redirect::back()->withInput()->withErrors('message', 'Email ou senha não estão corretos!');

				return Redirect::back()->with('message', '<span class=inputError>Email ou senha estão incorretos!</span>');

			}else{

				
				//return Auth::user();
				return Redirect::route('admin.index');

			}

		}

		public function destroy(){

			Auth::Logout();

			return Redirect::route('sessions.create');

		}


	}
	

?>