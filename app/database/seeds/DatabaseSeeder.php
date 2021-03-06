<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UsersEficazTableSeeder');
		$this->call('StatusUsuariosEficazTableSeeder');
		$this->call('EstadosPaisTableSeeder');
		$this->call('TipoContaTableSeeder');
		$this->call('InstituicaoBancariaTableSeeder');
	}

}
