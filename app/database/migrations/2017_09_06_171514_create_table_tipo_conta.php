<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipoConta extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_conta_banco', function(Blueprint $table)
	    {

	    	$table->increments('id_tipo_conta');
	    	$table->string('tipo_conta',11);
	        // required for Laravel 4.1.26
			$table->timestamps();
			$table->softDeletes();

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
		Schema::drop('tipo_conta_banco');
	}

}
