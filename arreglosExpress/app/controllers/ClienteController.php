<?php 
class ClienteController extends BaseController {
 
    /**
     * Muestra la lista con todos los clientes
     */
    public function listCliente()
    { 
        //obtenemos los registros de los productos guardados en la bd
       // $listCliente = Cliente::all();   
        echo "fernanda"; //die();
        //setear valores de los campos de fecha -- por default 90 dias hacia atras
        /*$diasAtras90 = time()-(180*24*60*60);//
        $feIni =  date('Y-m-d',$diasAtras90);
        $feFin = date("Y-m-d", time());   */      

        //pasar los parametros a la vista
        return View::make('Admin.listCliente', 
                        array( // 'listCliente' => $listCliente,
//                              'feIni' => $feIni,
//                              'feFin' => $feFin,
//                              'dsNombre' => '',
                            ));
    }
    
    /**
     * Busca y retorna el listado de productos mediante filtros
     */
    /*public function getListByFiltro()
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
    }*/
    
    
    /*
     * insert nuevo producto en la bd
     */
    public function nuevoProducto()
    {
        if(Request::ajax()){
                        
            $Producto = new Producto;
            $Producto->dsNombre = trim($_POST['txtNombreProducto']);
            $Producto->dsDescripcion = trim($_POST['txtDescripcion']);
            $Producto->noPrecio = number_format((float)trim($_POST['txtPrecio']),2, '.', '');
            $Producto->noStock = (int)trim($_POST['txtStock']);

            $res = $Producto->save();
                                    
            if((int)$res == 1){//insert ok                
                return Response::json(array(
			    'error' => 0,
                            'idProducto' =>$Producto->id
			));                 
            }else{//error en la actualizaion
                return Response::json(array(
			    'error' => 1,
			    'detalle' => 'No se puedo insertar el registro'
			)); 
            }          
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
    }
           
    public function editarProducto()
    {
        $idProducto = (int)$_GET['idProducto'];
        
        //obtener datos del producto
        $Producto = Producto::find($idProducto);
        
        $usuarios = Usuario::all(); 
        
        //obtener imagenes del producto
        $listProductoImagen = DB::table('cProductoImagen')
                    ->where('idProducto', '=', $idProducto)
                    ->where('cnVisible',  '=', 1)
                    ->get();
                    
         return View::make('Admin.editarProducto',
                        array('idProducto' => $idProducto,
                              'dsNombre' => $Producto->dsNombre,
                              'dsDescripcion' => $Producto->dsDescripcion,  
                              'noPrecio' => $Producto->noPrecio,    
                              'noStock' => $Producto->noStock,   
                              'listProductoImagen' => $listProductoImagen,
                              'usuarios'=>$usuarios,
                            ));
    }
            
    /*
     * actualizar datos del producto
     */
    public function updateProducto()
    {
        if(Request::ajax()){
              
            //buscar como hacer el update
            /*
            $Producto = new Producto;
            $Producto->dsNombre = trim($_POST['txtNombreProducto']);
            $Producto->dsDescripcion = trim($_POST['txtDescripcion']);
            $Producto->noPrecio = number_format((float)trim($_POST['txtPrecio']),2, '.', '');
            $Producto->noStock = (int)trim($_POST['txtStock']);
            */

            $res = $Producto->save();
                                    
            if((int)$res == 1){//insert ok                
                return Response::json(array(
			    'error' => 0,
                            'idProducto' =>$Producto->id
			));                 
            }else{//error en la actualizaion
                return Response::json(array(
			    'error' => 1,
			    'detalle' => 'No se puedo insertar el registro'
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