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
    
    //ruta Admin Pantalla cliente
    Route::get('AdminCliente', 'ClienteController@listCliente');
    
    //ruta Admin Pantalla cliente
    Route::post('AdminCliente', 'ClienteController@getListByFiltro');
    
    //ruta Admin Pantalla cliente detalle
    Route::get('AdminClienteDetalle', 'ClienteController@clienteDetalle');
    
    //admin pantalla de productos con filtro
    Route::post('AdminProducto', 'ProductoController@getListByFiltro');
    
    //handle para eliminar/desactivar el producto
    Route::post('EliminaProducto', 'ProductoController@eliminaProducto');
    
    //handle para nuevo producto 
    Route::get('NuevoProducto', function()
    {
        return View::make('Admin.nuevoProducto');
    }); 
    
    //handle para eliminar/desactivar el producto
    Route::post('GuardaProducto', 'ProductoController@nuevoProducto');
    
    // handle para editar el producto
    Route::get('EditarProducto', 'ProductoController@editarProducto');      
    
    //uploadArchivoHandle
    Route::post('uploadArchivoHandle', 'ProductoController@guardaImagen');
    
    //handle para eliminar/desactivar la imagen del producto
    Route::post('EliminaProductoImagen', 'ProductoController@eliminaProductoImagen');
    
    // handle para editar el producto
    Route::post('UpdateProducto', 'ProductoController@updateProducto');  
    
    //ruta Admin Pantalla Venta
    Route::get('AdminVenta', 'OrdenController@listOrden');
    
    //ruta Admin Pantalla Venta Por Filtro
    Route::post('AdminVenta', 'OrdenController@getListByFiltro');
    
    // Esta ruta nos servira para cerrar sesion.
    Route::get('logout', 'AuthController@logOut');      
    
//}); 
