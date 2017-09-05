<?php

class VendedoresDados extends Eloquent {

    /**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'vendedores_dados';

	protected $primaryKey 	= 'id_vendedor';

	protected $fillable 	= ['id_usuario', 'nomeCompleto', 'nomeFantasia', 'rgVendedor', 'cpfCnpj', 'generoVendedor', 'foto'];

	public $errors;
    
	public static $rules = array(
    	'nomeCompleto'=>'required|min:2',
        'rgVendedor'=>'numeric',
    	'cpfCnpj'=>'required|alpha_num|cpfCnpj'
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
	
}