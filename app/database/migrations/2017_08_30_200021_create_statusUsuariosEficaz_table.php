<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusUsuariosEficazTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		//Colunas da tabela UsersEficaz Table quando ela for gerada

		Schema::create('statusUsuariosEficaz', function(Blueprint $table)
	    {
	    	$table->increments('id_status');
			$table->string('status_usuario',25);
			// required for Laravel 4.1.26
			$table->timestamps();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Ações para serem executadas ao reverter as ações da tabela
		Schema::drop('statusUsuariosEficaz');
	}

}
