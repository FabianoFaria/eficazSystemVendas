<?php
 
class UsersEficazController extends BaseController {


	protected $layout = "layouts.main";


	public function __construct() {
	    $this->beforeFilter('csrf', array('on'=>'post'));
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

}

?>