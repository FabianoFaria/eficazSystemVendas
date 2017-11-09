<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComicoesPagasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('comicoes_parceiros_pagas', function(Blueprint $table)
		{
			$table->increments('id_comicoes_paga');
			$table->string('id_parceiro_sistema', 11);
			$table->string('id_workflow', 11);
			$table->string('id_proposta', 11);
			$table->string('observacoes_pagamento', 255);
			$table->string('total_comicao', 255);
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
		Schema::drop('comicoes_parceiros_pagas');
	}

}
