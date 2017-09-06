<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInstituicaoBancaria extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instituicao_bancaria', function(Blueprint $table)
	    {

	    	$table->increments('id_instituicao_bancaria');
	    	$table->string('nome_instituicao_bancaria',100);
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
		Schema::drop('instituicao_bancaria');
	}

}
