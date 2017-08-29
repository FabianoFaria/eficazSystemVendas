<?php



// app/database/seeds/UsersEficazTableSeeder.php


class UsersEficazTableSeeder extends Seeder
{

	public function run()
	{

	    DB::table('usersEficazTable')->delete();
	    // User::create(array(
	    //     'nome_usuario'     => 'Admin',
	    //     'email_usuario' => 'sistemaeficaz@sistema.eficazsystem.com.br',
	    //     'senha_usuario' => Hash::make('eficaz!@#1968'),
	    //     //'senha_usuario' =>	crypt('eficaz!@#1968', '$2a$' .15. '$' . uniqid(mt_rand(), true) . '$'),
	    //     'status'    => '1',
	    // ));
	    DB::table('usersEficazTable')->insert([
            'nome_usuario'     => 'Admin',
	        'email_usuario' => 'sistemaeficaz@sistema.eficazsystem.com.br',
	        'senha_usuario' => Hash::make('eficaz!@#1968'),
	        //'senha_usuario' =>	crypt('eficaz!@#1968', '$2a$' .15. '$' . uniqid(mt_rand(), true) . '$'),
	        'status'    => '1',
        ]);
	}

}








?>