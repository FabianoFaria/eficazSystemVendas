<?php



class StatusUsuariosEficazTableSeeder extends Seeder
{

	public function run()
	{

	    DB::table('statusUsuariosEficaz')->delete();
	    
	    DB::table('statusUsuariosEficaz')->insert([
            'status_usuario'     => 'Admin'
        ]);
        DB::table('statusUsuariosEficaz')->insert([
            'status_usuario'     => 'Vendedores'
        ]);
        DB::table('statusUsuariosEficaz')->insert([
            'status_usuario'     => 'Cliente'
        ]);
	}

}


?>