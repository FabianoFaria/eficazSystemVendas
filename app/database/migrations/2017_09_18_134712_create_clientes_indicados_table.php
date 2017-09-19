<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesIndicadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('clientes_indicados', function(Blueprint $table)
	    {

	    	$table->increments('id_cliente_indicado');
	    	$table->string('id_user', 11);
	    	$table->string('nome_completo', 255);
	    	$table->string('nome_fantasia_cliente', 255);
	    	$table->string('email_cliente', 75);
	    	$table->date('data_nascimento');
	    	$table->string('cpf_cnpj',20);
	    	$table->string('cliente_imagem_documento',255);
	    	$table->string('id_cadastro', 11);
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
		Schema::drop('clientes_indicados');
	}

}
