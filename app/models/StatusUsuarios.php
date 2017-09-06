<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

	class StatusUsuarios extends Eloquent {

		use SoftDeletingTrait;

		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table 		= 'statusUsuariosEficaz';

		protected $primaryKey 	= 'id_status';

		protected $fillable 	= ['status_usuario'];


		
	}


?>