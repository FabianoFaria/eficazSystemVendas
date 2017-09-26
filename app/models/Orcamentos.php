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

	protected $fillable 	= [''];

	public $errors;
    
	public static $rules = array();


}
