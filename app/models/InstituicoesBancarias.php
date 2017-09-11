<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class InstituicoesBancarias extends Eloquent {

    use SoftDeletingTrait;

    /**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'instituicao_bancaria';

	protected $primaryKey 	= 'id_instituicao_bancaria';

	protected $fillable 	= ['nome_instituicao_bancaria'];

	public $errors;
    
	public static $rules = array(
    	'nome_instituicao_bancaria'=>'required|min:2'
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