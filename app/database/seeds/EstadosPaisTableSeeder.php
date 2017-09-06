<?php



class EstadosPaisTableSeeder extends Seeder
{

	public function run()
	{

	    DB::table('estados_pais')->delete();
	    
	    DB::table('estados_pais')->insert([
            'nome_estado'     => 'Acre',
            'sigla_estado'     => 'AC'
        ]);
        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Alagoas',
            'sigla_estado'     => 'AL'
        ]);
        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Amapá',
            'sigla_estado'     => 'AP'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Amazonas',
            'sigla_estado'     => 'AM'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Bahia',
            'sigla_estado'     => 'BA'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Ceará',
            'sigla_estado'     => 'CE'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Distrito Federal',
            'sigla_estado'     => 'DF'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Espirito Santo',
            'sigla_estado'     => 'ES'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Goiás',
            'sigla_estado'     => 'GO'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Maranhão',
            'sigla_estado'     => 'MA'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Mato Grosso do Sul',
            'sigla_estado'     => 'MS'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Mato Grosso',
            'sigla_estado'     => 'MT'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Minas Gerais',
            'sigla_estado'     => 'MG'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Pará',
            'sigla_estado'     => 'PA'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Paraíba',
            'sigla_estado'     => 'PB'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Paraná',
            'sigla_estado'     => 'PR'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Pernambuco',
            'sigla_estado'     => 'PE'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Piauí',
            'sigla_estado'     => 'PI'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Rio de Janeiro',
            'sigla_estado'     => 'RJ'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Rio Grande do Norte',
            'sigla_estado'     => 'RN'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Rio Grande do Sul',
            'sigla_estado'     => 'RS'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Rondônia',
            'sigla_estado'     => 'RO'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Roraima',
            'sigla_estado'     => 'RR'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Santa Catarina',
            'sigla_estado'     => 'SC'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'São Paulo',
            'sigla_estado'     => 'SP'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Sergipe',
            'sigla_estado'     => 'SE'
        ]);

        DB::table('estados_pais')->insert([
            'nome_estado'     => 'Tocantins',
            'sigla_estado'     => 'TO'
        ]);
	}

}


?>
