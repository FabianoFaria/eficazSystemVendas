<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnderecosVendedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('vendedores_enderecos', function(Blueprint $table)
	    {
	    	$table->increments('id_endereco');
	    	$table->string('id_user',11);
			$table->string('cep_endereco',10);
			$table->string('logradouro',255);
			$table->string('numero',11);
			$table->string('complemento',255)->nullable();
	        $table->string('bairro', 255);
	        $table->string('cidade', 255);
	        $table->string('uf', 11);
	        $table->string('status_endereco', 2)->default(1);
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
		Schema::drop('vendedores_enderecos');
	}

}
