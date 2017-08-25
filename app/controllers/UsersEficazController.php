<?php
 
class UsersEficazController extends BaseController {


	protected $layout = "layouts.main";


	public function getLogin() {
	    $this->layout->content = View::make('layouts.main');
	}

	public function getRegister() {
	    $this->layout->content = View::make('usersEficaz.register');
	}

	public function postCreate() {
    	$validator = Validator::make(Input::all(), User::$rules);
 
	    if ($validator->passes()) {
	        // validation has passed, save user in DB
	    } else {
	        // validation has failed, display error messages    
	    }
	}

 
}

?>