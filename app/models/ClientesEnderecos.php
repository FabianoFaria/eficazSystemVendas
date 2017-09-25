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

	protected $fillable 	= ['logradouro','numero','complemento','bairro','cidade','estado_endereco', 'cep'];

	public static $rules 	= array(
		'logradouro'=> 'required|min:2',
        'bairro'=> 'required|min:2',
    	'cidade'=>'required',
    	'estado_endereco'=>'required',
    	'cep'=>'required|min:8|max:9',
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