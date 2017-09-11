<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class TipoContaBancaria extends Eloquent {

    use SoftDeletingTrait;

    /**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'tipo_conta_banco';

	protected $primaryKey 	= 'id_tipo_conta';

	protected $fillable 	= ['tipo_conta'];

	public $errors;
    
	public static $rules = array(
    	'tipo_conta'=>'required|min:2'
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