<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

	class EstadosPais extends Eloquent {

		use SoftDeletingTrait;

		/**
		* The database table used by the model.
		*
		* @var string
		*/
		protected $table 		= 'estados_pais';

		protected $primaryKey 	= 'id_estado';

	}