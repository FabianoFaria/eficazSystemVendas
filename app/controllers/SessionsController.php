<?php


	class SessionsController extends BaseController {

		public function __construct(User $user) {

		    $this->user = $user;
		}

		public function index(){

			//Verificação de validação
			if(Auth::check()){

				//Usuário logado
				return Redirect::to('/admin');

			}else{
				return View::make('usersEficaz.login');
				//return Redirect::to('/login');
			}

		}

		public function create(){

			//Verificação de validação
			if(Auth::check()){

				//Usuário logado
				return Redirect::to('/admin');

			}else{
				return View::make('usersEficaz.login');
				//return Redirect::to('/login');
			}

		}

		public function store(){

			//dd(Input::all());

			//if(Auth::attempt(Input::only('email_usuario','senha_usuario'))){

			$rules = array(
            	'senha_usuario'       	=> 'required',
            	'email_usuario'			=> 'required'
        	);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {

				$errors = $validator->messages();

	            return Redirect::back()->withInput()->withErrors($errors);

	        }else{

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
					$loginData  = array(
			            'email_usuario' => Input::get('email_usuario')
			        );

			        $errors = array(
			            'message' => 'Email ou senha estão incorretos!'
			        );

					return Redirect::back()->withInput($loginData)->withErrors($errors);

				}else{

					$status 	= StatusUsuarios::all();

					foreach ($status->all()  as $statu) {
						if($statu->id_status == Auth::user()->status){
							$status_usuario = $statu->status_usuario;
						}
					}


					//Configura algumas variaveis de sessão para guardar informações do usuário
					Session::put('nome_atual', Auth::user()->nome_usuario);
					Session::put('id_atual', Auth::user()->id);
					Session::put('status', $status_usuario);

					Cookie::queue("session_control","value", 10);
					
					//return Auth::user();
					return Redirect::route('admin.index');

				}
	        }

		}

		public function destroy(){

			Auth::Logout();
			Session::flush();
			
			//return Redirect::route('sessions.create');
			return Redirect::to('/');

		}


	}
	

?>