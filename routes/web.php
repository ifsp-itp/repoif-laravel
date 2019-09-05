<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//acesso sem logar
Route::get('/projects', 'ProjectController@index');
Route::get('/projects/show/{id}', 'ProjectController@show');


//login para acessar
Route::group(['middleware' => ['auth']], function () {

    //projeto
	Route::get('/projects/create', 'ProjectController@create');
	Route::post('/projects', 'ProjectController@store');
	Route::get('/projects/edit/{id}', 'ProjectController@edit')->middleware('auth:user');
	Route::put('/projects/show/{id}', 'ProjectController@update');
	Route::get('/projects/destroy/{id}', 'ProjectController@destroy');

	//baixar
	Route::get("/download/{file}", function ($file="") {
	return response()->download(storage_path("app/public/files/".$file));
	});

	//usuário
	Route::get('/user/profile/', 'UserController@profile');
    Route::get('/user/profile/{id}', 'UserController@profile');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
