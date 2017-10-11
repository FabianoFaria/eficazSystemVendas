<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendedoresPagamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('vendedoresPagamentos', function(Blueprint $table)
	    {
	    	$table->increments('id_pagamento_comissao'); 
	    	$table->string('id_orcamento', 11);
	    	$table->string('id_user', 11);
	    	$table->string('observacao_pgmt', 11);
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
		Schema::drop('vendedoresPagamentos');
	}

}
