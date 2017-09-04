<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TelefonesVendedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('vendedores_telefones', function(Blueprint $table)
	    {

	    	$table->increments('id_endereco');
	    	$table->string('id_user',11);
			$table->string('telefone',10);
			$table->string('observacacao_telefone',255)->nullable();
	        $table->string('status_telefone', 2)->default(1);
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
		Schema::drop('vendedores_telefones');
	}

}
