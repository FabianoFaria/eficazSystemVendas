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

	// public function getLogin() {
	//     $this->layout->content = View::make('usersEficaz.login');
	// }

	// public function getRegister() {
	//     $this->layout->content = View::make('usersEficaz.register');
	// }

	// public function postCreate() {
 //    	$validator = Validator::make(Input::all(), User::$rules);
 
	//     if ($validator->passes()) {


	//     	//Regras para dar segurança para a senha 

	//     	/* 
	// 			//CUSTO DO HASH
	//             $custo = 15;

	//             //GERAR SALT
	//             $salt = uniqid(mt_rand(), true);

	//             // Gera um hash baseado em bcrypt
	//             $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
	//     	*/


	//         // validation has passed, save user in DB
	//         $user = new User;
	// 	    $user->firstname = Input::get('firstname');
	// 	    $user->lastname = Input::get('lastname');
	// 	    $user->email = Input::get('email');
	// 	    $user->password = Hash::make(Input::get('password'));
	// 	    $user->save();
 
 //    		return Redirect::to('users/login')->with('message', 'Thanks for registering!');
	//     } else {
	//         // validation has failed, display error messages    
	//     }
	// }


	public function create(){

		return View::make('usersEficaz.create');

	}

	public function show($idUser){

		$user 		= User::find($idUser);

		$ativoDesde = $user->created_at;

		$ativoDesde = explode(' ', $ativoDesde);

		$ativoDesde = implode('/', array_reverse(explode('-',$ativoDesde[0])));

		//retorna a view com os dados necessarios.
		return View::make('usersEficaz.dadosUsuario', array( 'usuario' => $user, 'ativo_desde' => $ativoDesde));
		//return 'show usuário!';

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

	public function edit($idUser){

		$user = User::find($idUser);

		//retorna a view com os dados necessarios.
		return View::make('usersEficaz.editar', array( 'usuario' => $user));


	}

	public function update($id){


		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'nomeCliente'       	=> 'required',
            'emailEnd'      		=> 'required|email',
            'senhaUsuario' 			=> 'alpha_num|between:6,32|same:confirmaSenhaUsuario',
            'confirmaSenhaUsuario' 	=> 'alpha_num|between:6,32|same:senhaUsuario'
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {

        	return Redirect::to('users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('senhaUsuario'),Input::except('confirmaSenhaUsuario'));

        }else{

        	//dd(Input::all());

        	// Salvar o usuário
        	$this->user = User::find($id);
           	$this->user->nome_usuario = Input::get('nomeCliente');
			$this->user->email_usuario = Input::get('emailEnd');
			$this->user->status = 1;
			//Verifica se a senha será atualizada ou não
			if(Input::get('senhaUsuario') != ''){
				$this->user->senha_usuario = Hash::Make(Input::get('senhaUsuario'));
			}

			$this->user->save();

			// redirect
            Session::flash('message', 'Usuário foi atualizado com sucesso!');
            return Redirect::to('admin');

        }

		//return 'show edicao de usuário!';

	}
}

?>