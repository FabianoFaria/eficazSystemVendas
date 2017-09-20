<?php


use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ClientesIndicacoes extends Eloquent {


	use SoftDeletingTrait;

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'clientes_indicados';

	protected $primaryKey 	= 'id_cliente_indicado';

	protected $fillable 	= ['nome_completo'];

	public static $rules 	= array(
    	'nome_completo'=>'required|min:2',
    	'email_cliente'=>'required|email|unique:clientes_indicados',
    	'data_nascimento_criacao' => 'required|date_format:d/m/Y',
    	'cpf_cnpj' => 'required|cpfCnpj|unique:clientes_indicados',
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


