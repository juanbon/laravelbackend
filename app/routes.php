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

// PANTALLA DE BIENVENIDA
/*Route::get('/', function()
{
	return "Hello";
});
*/

Route::get('/', function(){

	echo "En construccion"; 
	exit; 

});
// Route::get('/index', 'BaseController@index');
// Route::get('/who_we_are', 'WhoweareController@index');


Route::group(array('prefix' => 'admin'), function(){
    // Config::set('auth.model', 'Admin');

	Route::get('/', 'Admin_LoginController@showLogin');
    Route::get('/login', 'Admin_LoginController@showLogin');
	Route::post('/login', 'Admin_LoginController@tryLogin')->where('user', '[0-9]+');;

	Route::group(array("before" => "loginCheck"), function(){

		Route::get('/logout', 'Admin_LoginController@getLogout');
		Route::get('/welcome', 'Admin_LoginController@welcome');

		Route::group(array('prefix' => 'admins/'), function(){
			Route::any('','Admin_AdminsController@listAll');
			Route::any('list/{page?}', 'Admin_AdminsController@listAll');
			Route::get('create', 'Admin_AdminsController@get_createItem');
			Route::post('create', 'Admin_AdminsController@post_createItem');
			Route::get('edit/{id}', 'Admin_AdminsController@get_editItem')->where('id', '[0-9]+');
			Route::post('edit/', 'Admin_AdminsController@post_editItem')->where('id', '[0-9]+');
			Route::get('delete/{id}', 'Admin_AdminsController@get_deleteItem')->where('id', '[0-9]+');
			Route::post('delete/', 'Admin_AdminsController@post_deleteItem');
			Route::get('visible/{id}', 'Admin_AdminsController@get_visibleItem')->where('id', '[0-9]+');
			Route::get('export', 'Admin_AdminsController@exportAll');
		});

		Route::group(array('prefix' => 'users/'), function(){
			Route::any('','Admin_UsersController@listAll');
			Route::any('list/{page?}', 'Admin_UsersController@listAll');
			Route::get('create', 'Admin_UsersController@get_createItem');
			Route::post('create', 'Admin_UsersController@post_createItem');
			Route::get('edit/{id}', 'Admin_UsersController@get_editItem')->where('id', '[0-9]+');
			Route::post('edit/', 'Admin_UsersController@post_editItem')->where('id', '[0-9]+');
			Route::get('delete/{id}', 'Admin_UsersController@get_deleteItem')->where('id', '[0-9]+');
			Route::post('delete/', 'Admin_UsersController@post_deleteItem');
			Route::get('visible/{id}', 'Admin_UsersController@get_visibleItem')->where('id', '[0-9]+');
			Route::get('export', 'Admin_UsersController@exportAll');
		});


			Route::group(array('prefix' => 'usuarios/'), function(){
		Route::any('','Admin_UsuariosController@listAll');
		Route::any('list/{page?}', 'Admin_UsuariosController@listAll');   
		Route::get('view/{id}', 'Admin_UsuariosController@get_viewItem')->where('id', '[0-9]+');
		Route::get('create', 'Admin_UsuariosController@get_createItem');
		Route::post('create', 'Admin_UsuariosController@post_createItem');
		Route::get('edit/{id}', 'Admin_UsuariosController@get_editItem')->where('id', '[0-9]+');
		Route::post('edit/', 'Admin_UsuariosController@post_editItem')->where('id', '[0-9]+');
		Route::get('delete/{id}', 'Admin_UsuariosController@get_deleteItem')->where('id', '[0-9]+');
		Route::post('delete/', 'Admin_UsuariosController@post_deleteItem');
		Route::get('visible/{id}', 'Admin_UsuariosController@get_visibleItem')->where('id', '[0-9]+');
		Route::get('export', 'Admin_UsuariosController@exportAll');
		Route::get('download/{file}', 'Admin_UsuariosController@get_download')->where('file', '[0-9]+');
	});

	});

});


// SOLO PARA CREAR LAS TABLAS POR PRIMERA VEZ 

Route::get('/create/db', function()
{



	Schema::create('admin', function($tabla)
	{
		$tabla->increments('id');
		$tabla->string('user', 32);
		$tabla->string('email', 320);
		$tabla->string('password', 60);
		$tabla->tinyInteger('visible')->default(1);
		$tabla->string('remember_token', 320)->nullable();
		$tabla->text('access');
		$tabla->enum('role', array('sadmin', 'admin'))->default("admin");
		$tabla->timestamps();
	});
	
	//para las nuevas secciones
	$section		= new stdClass();
	$actions		= array('create' => 1 , 'delete' => 1 , 'edit' => 1, 'view' => 1, 'export' => 1);
	$section->admin	= (object)$actions;
	$section->users	= (object)$actions;	
	DB::table('admin')->insert(array('user' => 'admin', 'email' => 'admin@admin.com', 'password' => 'No Te Metas', 'role' => 'sadmin', 'access' => serialize($section)));

}); 