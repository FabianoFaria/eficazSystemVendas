<?php


class VendedoresEnderecos extends Eloquent {


	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'vendedores_enderecos';

	protected $primaryKey 	= 'id_endereco';

	protected $fillable 	= [];

	public $errors;
    
	public static $rules = array(
  
    );


}