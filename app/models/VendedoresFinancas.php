<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class VendedoresFinancas extends Eloquent {

    use SoftDeletingTrait;

    /**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'vendedores_finaceiros';

	protected $primaryKey 	= 'id_conta_vendedor';

	protected $fillable 	= ['id_user', 'nomeConta', 'numeroConta', 'instituicao', 'tipoConta'];

	public $errors;
    
	public static $rules = array(
    	'nomeConta'=>'required|min:2',
        'numeroConta'=>'required|min:5',
        'instituicao'=>'required',
        'tipoConta'=>'required'
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