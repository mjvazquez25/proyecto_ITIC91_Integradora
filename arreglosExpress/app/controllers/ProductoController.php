<?php 
class ProductoController extends BaseController {
 
    /**
     * Mustra la lista con todos productos
     */
    public function listProducto()
    {
        //obtenemos los registros de los productos guardados en la bd
        $listProducto = Producto::all();         
        
        //setear valores de los campos de fecha -- por default 90 dias hacia atras
        $diasAtras90 = time()-(180*24*60*60);
        $feIni =  date('Y-m-d',$diasAtras90);
        $feFin = date("Y-m-d", time());         
                            
        //pasar los parametros a la vista
        return View::make('Admin.listProducto', 
                        array('listProducto' => $listProducto,
                              'feIni' => $feIni,
                              'feFin' => $feFin  
                            ));
    }
    
    /**
     * Busca y retorna el listado de productos mediante filtros
     */
    public function getListByFiltro()
    {        
        //obtenemos los registros de los productos que coincidan con los datos de busqueda    
        $Producto = new Producto();
        $listProducto = $Producto->getListByFiltro($_POST);
        
        //setear valores de los filtros
        $feIni =  date('Y-m-d', strtotime($_POST['fechaInicio']));
        $feFin = date("Y-m-d", strtotime($_POST['fechaFin'])); 
        $dsNombre = trim($_POST['dsNombreProducto']);
                       
        //pasar los parametros a la vista
        return View::make('Admin.listProducto',
                        array('listProducto' => $listProducto,
                              'feIni' => $feIni,
                              'feFin' => $feFin,
                              'dsNombre' => $dsNombre 
                            ));
    }
 
}
?>