<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
    use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usersEficazTable';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = ['nomeCliente', 'emailEnd', 'senhaNovoUsuario', 'confirmaSenhaNovoUsuario'];

	public $errors;

	public static $rules = array(
    	'nomeCliente'=>'required|min:2',
    	'email'=>'required|email|unique:usersEficazTable,email_usuario',
    	'senhaNovoUsuario'=>'required|between:6,32',
    	'confirmaSenhaNovoUsuario' =>'required|between:6,32|same:senhaNovoUsuario'
    );


    public function isValid($data){

    	//FAZENDO A VALIDAÇÃO COM OS ATRIBUTOS DO PROPRIO OBJETO
    	//$validacao = Validator::Make($this->attributes, static::$rules);

    	$validacao = Validator::Make($data, static::$rules);

    	if($validacao->passes()){

    		return true;

    	}else{

    		$this->errors = $validacao->messages();

    		return false;

    	}

    }

    public function isValidLogin($data){

        if(Auth::attempt($data, true)){

            return Auth::user();

            //return true;

        }else{

            //return Redirect::back()->withInput()->withErrors($validator);
            return false;
        }


    }

    public function getAuthPassword() {

        //Indica qual a coluna de senha que a Classe Eloquent irá utilizar para a validação de login
        return $this->senha_usuario;
    }

}
