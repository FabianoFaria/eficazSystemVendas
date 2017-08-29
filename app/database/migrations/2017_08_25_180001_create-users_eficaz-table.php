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

		Schema::create('usersEficazTable', function(Blueprint $table)
	    {
	    	$table->increments('id');
			$table->string('nome_usuario',20);
			$table->string('email_usuario',100)->unique();
			$table->string('senha_usuario', 64);
			$table->string('status',2);
			// required for Laravel 4.1.26
	        $table->string('remember_token', 100)->nullable();
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
		//Ações para serem executadas ao reverter as ações da tabela
		Schema::drop('usersEficazTable');
	}

}
