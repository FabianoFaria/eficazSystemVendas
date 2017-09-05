<?php

class VendedoresTelefones extends Eloquent {


	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'vendedores_telefones';

	protected $primaryKey 	= 'id_telefone';

	protected $fillable 	= [];

	public $errors;
    
	public static $rules = array(
  
    );


}