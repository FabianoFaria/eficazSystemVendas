<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VendedoresDadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('vendedores_dados', function(Blueprint $table)
	    {
	    	$table->increments('id_vendedor');
	    	$table->string('id_user',11);
			$table->string('nome_vendedor',140);
			$table->string('nome_fantasia',140)->nullable();
			$table->string('cnpj_cpf',140);
			$table->string('genero',2);
	        $table->string('foto', 255)->nullable();
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
		//
		//Ações para serem executadas ao reverter as ações da tabela
		Schema::drop('vendedores_dados');
	}

}
