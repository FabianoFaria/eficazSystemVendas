<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersEficazTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Colunas da tabela UsersEficaz Table quando ela for gerada

		$table->increments('id_usuario');
		$table->string('nome_usuario',20);
		$table->string('nome_usuario',20);
		$table->string('email_usuario',100)->unique();
		$table->string('status',2);
		$table->timestamps();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Ações para serem executadas ao reverter as ações da tabela
		Schema::drop('usersEficazTable');
	}

}
