<?php 
class OrdenController extends BaseController {
 
    /**
     * Mustra la lista de todas las ordenes
     */
    public function listOrden()
    {        
        $listOrden = DB::table('corden')
            ->join('carrocompra', 'corden.idCarroCompra', '=', 'carrocompra.id')
            ->join('cestatusventa', 'corden.idEstatusVenta', '=', 'cestatusventa.id')
            ->join('cmoneda', 'carrocompra.idMoneda', '=', 'cmoneda.id') 
            ->join('ccliente', 'corden.idCliente', '=', 'ccliente.id')
            ->select('corden.id', 'cestatusventa.dsEstatusVenta', 'corden.mnTransaccion','cmoneda.dsSimbolo',
                    'ccliente.dsNombre', 'ccliente.dsApellidoPaterno', 'ccliente.dsEmail')
            ->get();
        
        //print_r($listOrden); die();
        $listEstatusVenta = EstatusVenta::all();
        
        //setear valores de los campos de fecha -- por default 90 dias hacia atras
        $diasAtras90 = time()-(180*24*60*60);
        $feIni =  date('Y-m-d',$diasAtras90);
        $feFin = date("Y-m-d", time());
        
        return View::make('Admin.listOrden', 
                        array( 'listOrden' => $listOrden,
                               'listEstatusVenta' => $listEstatusVenta,
                               'EstatusVentaSelected' => -1,
                               'feIni' => $feIni,
                               'feFin' => $feFin,
                            ));
    }
    
    /**
     * Busca y retorna el listado de Ordenes mediante filtros
     */
    public function getListByFiltro()
    {        
        
        //obtenemos los registros que coincidan con los datos de busqueda          
        $listOrden = DB::table('corden')
            ->join('carrocompra', 'corden.idCarroCompra', '=', 'carrocompra.id')
            ->join('cestatusventa', 'corden.idEstatusVenta', '=', 'cestatusventa.id')
            ->join('cmoneda', 'carrocompra.idMoneda', '=', 'cmoneda.id') 
            ->join('ccliente', 'corden.idCliente', '=', 'ccliente.id')
            ->select('corden.id', 'cestatusventa.dsEstatusVenta', 'corden.mnTransaccion','cmoneda.dsSimbolo',
                    'ccliente.dsNombre', 'ccliente.dsApellidoPaterno', 'ccliente.dsEmail')
            ->where('corden.idEstatusVenta', '=', (int)$_POST['cmbEstatusVenta'])
            ->get();
        
        //obtener listado de estatus
         $listEstatusVenta = EstatusVenta::all();
         
        //setear valores de los filtros
        $feIni =  date('Y-m-d', strtotime($_POST['fechaInicio']));
        $feFin = date("Y-m-d", strtotime($_POST['fechaFin'])); 
        //$dsNombre = trim($_POST['dsNombreProducto']);
                       
        return View::make('Admin.listOrden', 
                        array( 'listOrden' => $listOrden,
                               'listEstatusVenta' => $listEstatusVenta,
                               'EstatusVentaSelected' => -1,
                               'feIni' => $feIni,
                               'feFin' => $feFin,
                            ));
    }
    
    public function editarOrden()
    {
        $idProducto = (int)$_GET['idProducto'];
        
        //obtener datos del producto
        $Producto = Producto::find($idProducto);
                
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
                              'listProductoImagen' => $listProductoImagen                             
                            ));
    }
    
}
?>