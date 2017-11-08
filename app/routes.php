<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	//return View::make('hello');

	//return View::make('layouts.main');
	if(Auth::check()){

		//Usuário logado
		return Redirect::to('/admin');

	}else{

		return View::make('sitePrincipal.index');
	}
	
	
});

//Rotas para paginas estaticas do site

Route::get('sobre', function()
{
	return View::make('sitePrincipal.sobre');
});

Route::get('ajuda', function()
{
	return View::make('sitePrincipal.ajuda');
});

Route::get('faq', function()
{
	return View::make('sitePrincipal.ajuda');
});

//Route::get('users', 'UsersEficazController@index');

Route::get('login', 'SessionsController@create');

Route::get('logout', 'SessionsController@destroy');

//ROTAS PARA CADASTRO DE NOVO USUÁRIO
Route::get('registrar','UsersEficazController@criar_usuario');

Route::post('guarda_parceria', array('as' => 'users.nova_parceria','uses' => 'UsersEficazController@guardar_parceria'));

//ROTA PARA TELA DE BOAS VINDAS A UM NOVO USUÁRIO
Route::get('bemVindo','UsersEficazController@bemVindo');

Route::resource('sessions','SessionsController');

Route::get('marcarComoPago/{id}','OrcamentoController@marcarComoPago');

Route::post('gardar_pgmt',array('as' => 'orcamentos.gardar_pgmt', 'uses' => 'OrcamentoController@gardar_pgmt'));

//Rotas para direcionar para recuperação de senha

Route::get('relembrarSenha', 'RemindersController@getRemind');

Route::post('verificaEndereco', array('as' => 'RemindersController.postRemind', 'uses' => 'RemindersController@postRemind'));

Route::get('redefinirSenha/{token}', array('as' => 'RemindersController.getReset', 'uses' => 'RemindersController@getReset')); 

Route::post('definirSenhas', array('as' => 'RemindersController.postReset', 'uses' => 'RemindersController@postReset'));

Route::get('definirSenhas', function()
{
	return View::make('sitePrincipal.index');
});


Route::get('marcarComoPago/{id}', 'OrcamentoController@marcarComoPago');

//Rotas para serem acessadas via CRON 
//Route::get('orcamentosFechadosDia', 'OrcamentoController@contabilizarOrcamentosFechadosDia');

//Rota para recuperar dados do parceiro, requisitado pela API
Route::get('dadosParceiro/{id}', 'UsersEficazController@dadosParceiroApi');

// Route::get('admin', function(){

// 	return 'Admin page...';

// })->before('auth');


// route to show the login form
//Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
//Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::group(array('before' =>'auth'), function()
{

	//Rota para a sessão de Administrador

	Route::resource('admin','AdminController');

	Route::resource('users','UsersEficazController');

	//Rotas direcionadas ao cadastro do parceiro

	Route::resource('vendedores','VendedorDadosController');

	Route::resource('vendas','VendasController');

	Route::resource('enderecos','VendedorEnderecosController');

	Route::resource('telefones','VendedorTelefonesController');

	Route::resource('financas','VendedorFinancasController');

	//Rotas direcionadas ao cadastro de clientes

	Route::resource('indicacoes','IndicacaoController');

	Route::resource('enderecos_indicacoes','IndicacoesEnderecosController');

	Route::resource('telefones_indicacoes','IndicacoesTelefonesController');

	//Rotas direcionadas para gerenciamento de orçamentos

	Route::resource('orcamentos','OrcamentoController');

	Route::get('contabilizarComissaoParceiro', 'OrcamentoController@contabilizarComissaoParceiro');

	Route::get('solicitarPagamentoComissao', 'OrcamentoController@solicitarPagamentoComissao');

});


//REGRAS DE VALIDAÇÃO DE FORMULARIO
Validator::extend('cpfCnpjVal', 'CustomValidator@cpfCnpjVal');

Validator::extend('cpfCnpj', function($field,$value,$parameters){
	
	$strlen = strlen($value);

	if($strlen == 11){
		//Tratamento de CPF

		$soma = 0;
      
	    // Verifica 1º digito      
	    for ($i = 0; $i < 9; $i++) {         
	         $soma += (($i+1) * $value[$i]);
	    }

	    $d1 = ($soma % 11);
      
	    if ($d1 == 10) {
	        $d1 = 0;
	    }

	    $soma = 0;
      
	    // Verifica 2º digito
	    for ($i = 9, $j = 0; $i > 0; $i--, $j++) {
	        $soma += ($i * $value[$j]);
	    }
      
      	$d2 = ($soma % 11);

      	if ($d2 == 10) {
         	$d2 = 0;
      	}      
      
      	if ($d1 == $value[9] && $d2 == $value[10]) {
         	return true;
      	}
	    else {
	        return false;
	    }

	}elseif($strlen == 14){
		//Tratamento de CNPJ

		$soma = 0;
      
	    $soma += ($value[0] * 5);
	    $soma += ($value[1] * 4);
	    $soma += ($value[2] * 3);
	    $soma += ($value[3] * 2);
	    $soma += ($value[4] * 9); 
	    $soma += ($value[5] * 8);
	    $soma += ($value[6] * 7);
	    $soma += ($value[7] * 6);
	    $soma += ($value[8] * 5);
	    $soma += ($value[9] * 4);
	    $soma += ($value[10] * 3);
	    $soma += ($value[11] * 2); 

	    $d1 = $soma % 11; 
	    $d1 = $d1 < 2 ? 0 : 11 - $d1; 

		$soma = 0;
	    $soma += ($value[0] * 6); 
	    $soma += ($value[1] * 5);
	    $soma += ($value[2] * 4);
	    $soma += ($value[3] * 3);
	    $soma += ($value[4] * 2);
	    $soma += ($value[5] * 9);
	    $soma += ($value[6] * 8);
	    $soma += ($value[7] * 7);
	    $soma += ($value[8] * 6);
	    $soma += ($value[9] * 5);
	    $soma += ($value[10] * 4);
	    $soma += ($value[11] * 3);
	    $soma += ($value[12] * 2);

	    $d2 = $soma % 11; 
      	$d2 = $d2 < 2 ? 0 : 11 - $d2; 

      	if ($value[12] == $d1 && $value[13] == $d2) {
         	return true;
      	}
      	else {
         	return false;
      	}
	}else{
		return false;
	}

});