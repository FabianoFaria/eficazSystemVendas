<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;


class ClientesTelefones extends Eloquent {


	use SoftDeletingTrait;


	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'clientes_telefones';

	protected $primaryKey 	= 'id_cliente_telefone';

	protected $fillable 	= ['telefone'];

	public static $rules = array(
	  		'telefone'=> 'required|numeric|min:8',
	    );

	public $errors;

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

}