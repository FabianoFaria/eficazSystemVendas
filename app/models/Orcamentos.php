<?php


use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Orcamentos extends Eloquent {

	use SoftDeletingTrait;

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'orcamentos_indicados';

	protected $primaryKey 	= 'id_orcamento';

	protected $fillable 	= ['titulo_orcamento', 'descricao_orcamento'];

	public $errors;
    
	public static $rules = array(
		'titulo_orcamento'		=>'required|min:5',
		'descricao_orcamento'	=>'required|min:10'
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
