<?php
 
class UsersEficazController extends BaseController {


	protected $layout = "layouts.main";

	protected $user;

	public function __construct(User $user) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->user = $user;
	}

	public function index() {

		return View::make('usersEficaz.login');

		//Verifica se está logado ou não

		if(Auth::check()){

			//Usuário logado
			return Redirect::to('/admin');

		}else{
			return View::make('usersEficaz.login');
		}

	}

	public function getLogin() {
	    $this->layout->content = View::make('usersEficaz.login');
	}

	public function getRegister() {
	    $this->layout->content = View::make('usersEficaz.register');
	}

	public function postCreate() {
    	$validator = Validator::make(Input::all(), User::$rules);
 
	    if ($validator->passes()) {


	    	//Regras para dar segurança para a senha 

	    	/* 
				//CUSTO DO HASH
	            $custo = 15;

	            //GERAR SALT
	            $salt = uniqid(mt_rand(), true);

	            // Gera um hash baseado em bcrypt
	            $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
	    	*/


	        // validation has passed, save user in DB
	        $user = new User;
		    $user->firstname = Input::get('firstname');
		    $user->lastname = Input::get('lastname');
		    $user->email = Input::get('email');
		    $user->password = Hash::make(Input::get('password'));
		    $user->save();
 
    		return Redirect::to('users/login')->with('message', 'Thanks for registering!');
	    } else {
	        // validation has failed, display error messages    
	    }
	}


	public function create(){

		return View::make('usersEficaz.create');

	}

	public function store(){


		//OUTRO MODO DE EFETUAR A VALIDAÇÃO, INJETANDO OS DADOS DIRETO NO OBJETO E ENTÃO EFETUANDO A VALIDAÇÃO DENTRO DELE MESMO
		//$this->user->fill(Input::all());
		//
		//if( ! $this->user->isValid()){

		//Dentro da model User, fazer a validação do seguinte modo:
		//$validacao = Validator::Make($this->attributes, static::$rules);




		if( ! $this->user->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->user->errors);

		}else{

			// POR CONFLITOS COM AS REGRAS DE VALIDAÇÃO, OS ATRIBUTOS ESTÃO SENDO COLOCADOS MANUALMENTE
			//$this->user->create($input);

			// $senha 				=  Input::get('senhaNovoUsuario');
			// $senhaConfirmada 	=  Input::get('confirmaSenhaNovoUsuario');

			// if($senha == $senhaConfirmada){

				//CÓDIGO REFATORADO POR MOTIVOS DE MELHORIAS DE PRATICAS, COMO INSTANCIAÇÃO DA MODEL NA CONTROLER.
				// $user = new User();

			$this->user->nome_usuario = Input::get('nomeCliente');
			$this->user->senha_usuario = Hash::Make(Input::get('senhaNovoUsuario'));
			$this->user->email_usuario = Input::get('emailEnd');
			$this->user->status = 1;

				// //dd($user);

			$this->user->save();

				// Modo hardcoded
				//return Redirect::to('/users');

				// Modo Restful
			
			// return Redirect::route('users.index');
			return Redirect::route('users.index');

			// }else{

			// 	//return 'Falha de validação!';
			// 	return Redirect::back()->withInput()->withErrors(User::$errors);
			// }

		}

		//return Input::all();

		
		//$user = Input::all();

	}
}

?>