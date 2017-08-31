<?php


	class StatusUsuarios extends Eloquent {


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