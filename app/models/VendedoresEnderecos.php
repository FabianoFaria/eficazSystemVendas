<?php


use Illuminate\Database\Eloquent\SoftDeletingTrait;

class VendedoresEnderecos extends Eloquent {

    use SoftDeletingTrait;
    
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'vendedores_enderecos';

	protected $primaryKey 	= 'id_endereco';

	protected $fillable 	= ['logradouro','numero','complemento','bairro','cidade','estado_endereco', 'cep'];

	public $errors;
    
	public static $rules = array(
  		'logradouro'=> 'required|min:2',
        'bairro'=> 'required|min:2',
    	'cidade'=>'required',
    	'estado_endereco'=>'required',
    	'cep'=>'required',
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