<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use \GuzzleHttp\Exception\RequestException;


class ComissoesPagasParceiros extends Eloquent {


	use SoftDeletingTrait;


	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'comicoes_parceiros_pagas';

	protected $primaryKey 	= 'id_comicoes_paga';

	protected $fillable 	= ['id_comicoes_paga', 'id_parceiro_sistema', 'id_workflow', 'id_proposta', 'observacoes_pagamento', 'total_comicao'];

	public static $rules = array(
	  		'observacao'=>'max:250'
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
