<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendedoresFinaceiro extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('vendedores_finaceiros', function(Blueprint $table)
	    {

	    	$table->increments('id_conta_vendedor');
	    	$table->string('id_user',11);
			$table->string('nome_conta',35);
			$table->string('numero_conta',100);
			$table->string('instituicao',11);
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
		Schema::drop('vendedores_finaceiros');
	}

}
