<?php 
class ProductoController extends BaseController {
 
    /**
     * Mustra la lista con todos productos
     */
    public function listProducto()
    {
        //obtenemos los registros de los productos guardados en la bd
        $listProducto = Producto::all();         
        
        //pasar los parametros a la vista
        return View::make('Admin.listProducto', array('listProducto' => $listProducto));
    }
 
}
?>