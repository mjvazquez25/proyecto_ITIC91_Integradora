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
        $idOrden = (int)$_GET['idOrden'];
        echo "<pre>";
        //obtener datos de la orden
        $Orden = Orden::find($idOrden);
        print_r($Orden);
        
        //obtener datos del cliente
        $Cliente = Cliente::find($Orden->idCliente);
        print_r($Cliente);
                
        //obtener carro compra de la orden
        $CarroCompra = CarroCompra::find($Orden->idCarroCompra);
        print_r($CarroCompra);
        
        //obtener direccion de envio
        $Direccion = Direccion::find($CarroCompra->idDireccion);
        
        //obtener datos de pago
        $Pago = Pago::find($idOrden);
        
        //obtener estatus Pago
        
        //obtener carrito de compra
        $Carrito = DB::table('carrocompraproducto')
            ->join('cproducto', 'carrocompraproducto.idProducto', '=', 'cproducto.id')
            ->select('cproducto.dsNombre', 'carrocompraproducto.noCantidad')
            ->get();
        
        print_r($Carrito);
        echo "</pre>";
        /*
         return View::make('Admin.editarOrden',
                        array(
                              'idProducto' => $idProducto,
                              'dsNombre' => $Producto->dsNombre,
                              'dsDescripcion' => $Producto->dsDescripcion,  
                              'noPrecio' => $Producto->noPrecio,    
                              'noStock' => $Producto->noStock,   
                              'listProductoImagen' => $listProductoImagen                             
                            ));*/
    }
    
}
?>