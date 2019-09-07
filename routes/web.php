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

Route::get('/', 'ProjectController@index');

//acesso sem logar
Route::get('/projects', 'ProjectController@index');
Route::get('/projects/show/{id}', 'ProjectController@show');
Route::get('/user/profile/{id}', 'UserController@profile');


//login para acessar
Route::group(['middleware' => ['auth']], function () {

    //projeto
	Route::get('/projects/create', 'ProjectController@create');
	Route::post('/projects', 'ProjectController@store');
	Route::get('/projects/edit/{id}', 'ProjectController@edit');
	Route::put('/projects/show/{id}', 'ProjectController@update');
	Route::get('/projects/destroy/{id}', 'ProjectController@destroy');

	//like
	Route::put('/projects/like/{id}', 'ProjectController@darLike');

	//baixar
	Route::get("/download/{file}", function ($file="") {
	return response()->download(storage_path("app/public/files/".$file));
	});

	//usuário
	Route::get('/user/profile/', 'UserController@profile');
    

});

Auth::routes();

Route::get('/home', 'ProjectController@index');
