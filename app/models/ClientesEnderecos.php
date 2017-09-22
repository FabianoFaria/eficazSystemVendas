<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;


class ClientesEnderecos extends Eloquent {


	use SoftDeletingTrait;


	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'clientes_enderecos';

	protected $primaryKey 	= 'id_cliente_endereco';

	protected $fillable 	= [''];

	public static $rules 	= array();

	public $errors;

	public function isValid($data, $rulse){

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