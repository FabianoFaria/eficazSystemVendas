<?php

class InstituicaoBancariaTableSeeder extends Seeder
{

	public function run()
	{

	    DB::table('instituicao_bancaria')->delete();
	    
	    DB::table('instituicao_bancaria')->insert([
            'nome_instituicao_bancaria'	=> 'Banco do Brasil',
        ]);
         DB::table('instituicao_bancaria')->insert([
            'nome_instituicao_bancaria'	=> 'Caixa econômica Federal',
        ]);
	}

}