<?php

	use Illuminate\Database\Eloquent\SoftDeletingTrait;


	class VendedoresPagamentos extends Eloquent {

		use SoftDeletingTrait;

		/**
		* The database table used by the model.
		*
		* @var string
		*/
		protected $table 		= 'vendedoresPagamentos';

		protected $primaryKey 	= 'id_pagamento';

		protected $fillable 	= ['id_orcamento', 'id_user', 'observacao_pgmt'];

		public $errors;
    
		public static $rules = array(
			'observacao_pgmt'		=>'required|min:5'
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