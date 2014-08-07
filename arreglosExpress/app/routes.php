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
	return View::make('public.hello');
});

/****************************
 * 
 *  SECCION DE FRONT-END [USUARIO / PUBLICO]
 * 
 *************************************/

Route::get('Usuario', 'UsuariosController@mostrarUsuarios');

Route::get('Galeria', 'GaleriaController@displayProductos');

Route::post('UpdateCarrito', 'CarritoController@UpdateCarrito');

Route::post('GetCarrito', 'CarritoController@getCarrito');

Route::get('DetalleCompra', 'CarritoController@DetalleCompra');

Route::get('DatosCliente', 'CarritoController@DatosCliente');

Route::post('verificaCorreoCliente', 'CarritoController@verificaCorreoCliente');

Route::post('updateDatosCliente', 'ClienteController@updateDatosCliente');

Route::get('Contacto', function()
{
	return View::make('public.contacto');
});

Route::post('GuardaMensaje', 'MensajeContactoController@GuardaMensaje');


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
    
    //ruta Admin Pantalla Ver detalle Orden/Compra
    Route::get('EditarOrden', 'OrdenController@editarOrden');
    
    //ruta Admin Exportar reporte de ventas a excel
    Route::get('OrdenExportarExcel', 'OrdenController@exportarExcel');
    
     //handle para marcar como enviado/no enviado el pedido
    Route::post('UpdateEstatusEnvioOrden', 'OrdenController@cambioEstadoEnvioOrden');
    
    //ruta Admin Pantalla Mensajes
    Route::get('AdminMensajeContacto', 'MensajeContactoController@listMensaje');
    
     //ruta Admin Pantalla Mensajes Por Filtro
    Route::post('AdminMensajeContacto', 'MensajeContactoController@getListByFiltro');
    
    //ruta Admin ajax Ver detalle Mensaje
    Route::post('VerDetalleMensaje', 'MensajeContactoController@mensajeDetalle');
    
    // Esta ruta nos servira para cerrar sesion.
    Route::get('logout', 'AuthController@logOut');      
    
//}); 
