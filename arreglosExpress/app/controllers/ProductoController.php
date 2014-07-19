<?php 
class ProductoController extends BaseController {
 
    /**
     * Mustra la lista con todos productos
     */
    public function listProducto()
    { 
        //obtenemos los registros de los productos guardados en la bd
        $listProducto = Producto::where('cnActivo', '=', 1)->get();   
        
//        //setear valores de los campos de fecha -- por default 90 dias hacia atras
        $diasAtras90 = time()-(180*24*60*60);
        $feIni =  date('Y-m-d',$diasAtras90);
        $feFin = date("Y-m-d", time());         

//        //pasar los parametros a la vista
        return View::make('Admin.listProducto', 
                        array( 'listProducto' => $listProducto,
                              'feIni' => $feIni,
                              'feFin' => $feFin,
                              'dsNombre' => '',
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
    
    /*
     * actualiza el campo cnActivo en la BD
     */
    public function eliminaProducto()
    {
        if(Request::ajax()){
                        
            $res = Producto::where('id', (int)$_POST['idProducto'])
                      ->update(array('cnActivo' => 0));
                        
            if((int)$res == 1){//actualizacion ok                
                return Response::json(array(
			    'error' => 0
			));                 
            }else{//error en la actualizaion
                return Response::json(array(
			    'error' => 1,
			    'detalle' => 'No se puedo actualizar el registro'
			)); 
            }            
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
    }
    
    
 
}
?>