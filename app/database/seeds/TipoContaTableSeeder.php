<?php

class TipoContaTableSeeder extends Seeder
{

	public function run()
	{

	    DB::table('tipo_conta_banco')->delete();
	    
	    DB::table('tipo_conta_banco')->insert([
            'tipo_conta'	=> 'Corrente',
        ]);
         DB::table('tipo_conta_banco')->insert([
            'tipo_conta'	=> 'Poupança',
        ]);
	}

}