<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientesEnderecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('clientes_enderecos', function(Blueprint $table)
	    {
	    	$table->increments('id_cliente_endereco'); 
	    	$table->integer('id_endereco_sistema_eficaz', 11);
	    	$table->integer('id_cliente_indicado', 11);
	    	$table->string('cep_endereco',10);
			$table->string('logradouro',255);
			$table->string('numero',11);
			$table->string('complemento',255)->nullable();
	        $table->string('bairro', 255);
	        $table->string('cidade', 255);
	        $table->string('uf', 11);
	        $table->string('status_endereco', 2)->default(1);
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
		Schema::drop('clientes_enderecos');
	}

}
