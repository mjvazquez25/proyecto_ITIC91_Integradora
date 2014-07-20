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
//Route::group(array('before' => 'auth'), function()
//{
    // Esta sera nuestra ruta de bienvenida al Administradors
    Route::get('HomeAdmin', function()
    {
        return View::make('Admin.homeAdmin');
    }); 
    
    //ruta Admin pantalla de productos
    Route::get('AdminProducto', 'ProductoController@listProducto');
    
    //admin pantalla de productos con filtro
    Route::post('AdminProducto', 'ProductoController@getListByFiltro');
    
    //handle para eliminar/desactivar el producto
    Route::post('EliminaProducto', 'ProductoController@eliminaProducto');
    
    //handle para nuevo producto pantalla
    Route::get('NuevoProducto', function()
    {
        return View::make('Admin.nuevoProducto');
    }); 
    
    //handle para eliminar/desactivar el producto
    Route::post('GuardaProducto', 'ProductoController@nuevoProducto');
    
    //uploadArchivoHandle
    Route::post('uploadArchivoHandle', 'ProductoController@guardaImagen');
    
    // Esta ruta nos servira para cerrar sesion.
    Route::get('logout', 'AuthController@logOut');      
    
//}); 
