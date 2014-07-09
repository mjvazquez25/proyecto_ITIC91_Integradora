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
	return View::make('hello');
});

/****************************
 * 
 *  SECCION DE FRONT-END [USUARIO / PUBLICO]
 * 
 *************************************/

Route::get('Usuario', 'UsuariosController@mostrarUsuarios');

/****************************
 * 
 *  SECCION DE BACK-END [ADMININISTRADOR]
 * 
 *************************************/

// Nos mostrara el formulario de login.
Route::get('Admin', 'AuthController@showLogin');

// Validamos los datos de inicio de sesion.
Route::post('Admin', 'AuthController@postLogin');

// Nos indica que las rutas que están dentro de al solo serán mostradas si antes el usuario se ha autenticado.
/*Route::group(array('before' => 'auth'), function()
{
    // Esta sera nuestra ruta de bienvenida.
    /*Route::get('/', function()
    {
        return View::make('hello');
    }); *
    
    // Esta ruta nos servira para cerrar sesion.
    Route::get('logout', 'AuthController@logOut');
    
}); */
