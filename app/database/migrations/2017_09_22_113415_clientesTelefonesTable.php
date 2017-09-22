<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientesTelefonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('clientes_telefones', function(Blueprint $table) 
	    {
	    	$table->increments('id_cliente_telefone');
	    	$table->string('id_cliente_indicado', 11);
	    	$table->string('id_telefone_sistema_eficaz', 11);
	    	$table->string('telefone_cliente', 25);
	    	$table->string('observacao_telefone', 120);
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
		//
		Schema::drop('clientes_telefones');
	}

}
