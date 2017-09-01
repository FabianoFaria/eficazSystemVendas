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

		return View::make('usersEficaz.login');
	}
	
	
});

//Route::get('users', 'UsersEficazController@index');

Route::get('login', 'SessionsController@create');

Route::get('logout', 'SessionsController@destroy');


Route::resource('sessions','SessionsController');


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

	Route::resource('vendas','VendasController');

	Route::resource('indicacoes','indicacaoController');

});