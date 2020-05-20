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
Route::get('/teste', 'ProjectController@facade');

//acesso sem logar
Route::get('/projects', 'ProjectController@index');
Route::get('/projects/sent', 'ProjectController@pesquisaSent');
Route::get('/projects/userProject/{id}', 'ProjectController@userProject');
Route::get('/projects/news', 'ProjectController@newProjects');
Route::get('/projects/photos', 'ProjectController@photosProjects');
Route::get('/projects/videos', 'ProjectController@videosProjects');
Route::get('/projects/codes', 'ProjectController@codesProjects');
Route::get('/projects/pdf', 'ProjectController@pdfProjects');
Route::post('/projects/search', 'ProjectController@search');
Route::get('/projects/show/{id}', 'ProjectController@show')->name('project.show');
Route::get('/user/profile/{id}', 'UserController@profile');

//FACE
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/facebook', 'SocialController@callback');


//login para acessar
Route::group(['middleware' => ['auth']], function () {

    //projeto
	Route::get('/projects/create', 'ProjectController@create');
	Route::post('/projects', 'ProjectController@store');

	Route::get('/projects/edit/{id}', 'ProjectController@edit');
	Route::put('/projects/show/{id}', 'ProjectController@update');
	Route::get('/projects/destroy/{id}', 'ProjectController@destroy');

	//like
	Route::post('/like/{id}', 'LikesController@store');

	//comentario
	Route::post('/coments/{id}', 'CommentsController@store');
	Route::get('/comment/destroy/{id}', 'CommentsController@destroy');

	//baixar
	Route::get("/download/{file}", function ($file="") {
	return response()->download(storage_path("app/public/files/".$file));
	});


	//usuário
	Route::get('/user/profile/', 'UserController@profile');
    Route::get('/user/edit/{id}', 'UserController@edit');
	Route::put('/user/profile/{id}', 'UserController@update')->name('user.update');
	
	//api github
	Route::get('/git/get', 'GithubController@indexRepositories')->name('github.index');
	Route::post('/git/post', 'GithubController@getRepositories')->name('github.get');

});

Auth::routes();

Route::get('/home', 'ProjectController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/address/{url}', 'ProjectController@callback')->name('url.site');

