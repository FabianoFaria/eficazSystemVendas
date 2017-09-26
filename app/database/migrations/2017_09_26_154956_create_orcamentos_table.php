<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrcamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('orcamentos_indicados', function(Blueprint $table)
	    {
	    	$table->increments('id_orcamento'); 
	    	$table->string('id_orcamento_sistema', 11);
	    	$table->string('id_cliente', 11);
	    	$table->string('id_user', 11);
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
		Schema::drop('orcamentos_indicados');
	}

}
