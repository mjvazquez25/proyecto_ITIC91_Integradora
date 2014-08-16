<?php 
class OrdenController extends BaseController {
 
    /**
     * Mustra la lista de todas las ordenes
     */
    public function listOrden()
    {        
        $listOrden = DB::table('cOrden')
            ->join('CarroCompra', 'cOrden.idCarroCompra', '=', 'CarroCompra.id')
            ->join('cEstatusVenta', 'cOrden.idEstatusVenta', '=', 'cEstatusVenta.id')
            ->join('cMoneda', 'CarroCompra.idMoneda', '=', 'cMoneda.id') 
            ->join('cCliente', 'cOrden.idCliente', '=', 'cCliente.id')
            ->select('cOrden.id', 'cEstatusVenta.dsEstatusVenta', 'cOrden.mnTransaccion','cMoneda.dsSimbolo',
                    'cCliente.dsNombre', 'cCliente.dsApellidoPaterno', 'cCliente.dsEmail')
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
                               'EstatusVentaSelected' => 1,
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
        $listOrden = DB::table('cOrden')
            ->join('CarroCompra', 'cOrden.idCarroCompra', '=', 'CarroCompra.id')
            ->join('cEstatusVenta', 'cOrden.idEstatusVenta', '=', 'cEstatusVenta.id')
            ->join('cMoneda', 'CarroCompra.idMoneda', '=', 'cMoneda.id') 
            ->join('cCliente', 'cOrden.idCliente', '=', 'cCliente.id')
            ->select('cOrden.id', 'cEstatusVenta.dsEstatusVenta', 'cOrden.mnTransaccion','cMoneda.dsSimbolo',
                    'cCliente.dsNombre', 'cCliente.dsApellidoPaterno', 'cCliente.dsEmail')
            ->where('cOrden.idEstatusVenta', '=', (int)$_POST['cmbEstatusVenta'])
            ->whereBetween('cOrden.created_at', array(
                                        date('Y-m-d',strtotime($_POST['fechaInicio']))." 00:00:00", 
                                        date('Y-m-d',strtotime($_POST['fechaFin']))." 23:59:59",))
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
                               'EstatusVentaSelected' => (int)$_POST['cmbEstatusVenta'],
                               'feIni' => $feIni,
                               'feFin' => $feFin,
                            ));
    }
    
    public function editarOrden()
    {
        $idOrden = (int)$_GET['idOrden'];        
        //obtener datos de la orden
        $Orden = Orden::find($idOrden);        
        //obtener datos del cliente
        $Cliente = Cliente::find($Orden->idCliente);                
        //obtener carro compra de la orden
        $CarroCompra = CarroCompra::find($Orden->idCarroCompra);        
        //obtener direccion de envio
        $Direccion = Direccion::find($CarroCompra->idDireccion);        
        
        //obtener datos de pago
        $Pago = Pago::where("idOrden","=",$idOrden)->get();
        
        //obtener estatus Pago
        $EstastusPago = EstatusPago::find($Pago[0]->idEstatusPago);
            
        $Carrito = DB::table('CarroCompraProducto')
        ->join('cProducto', 'CarroCompraProducto.idProducto', '=', 'cProducto.id')
        ->join('CarroCompra', 'CarroCompraProducto.idCarroCompra', '=', 'CarroCompra.id')
        ->join('cOrden', 'cOrden.idCarroCompra', '=', 'CarroCompra.id')
        ->select('cProducto.dsNombre', 'CarroCompraProducto.noCantidad','cProducto.id')
        ->where('cOrden.id','=',$idOrden)
        ->get();
        
        $Producto = new Producto();
        
         return View::make('Admin.editarOrden',
                        array(
                              'idOrden' => $idOrden,      
                              'Cliente' => $Cliente,
                              'CarroCompra' => $CarroCompra,
                              'Pago' => $Pago,
                              'EstastusPago' => $EstastusPago,
                              'Direccion' => $Direccion,
                              'Carrito' => $Carrito,
                              'Orden' => $Orden,
                              'Producto' => $Producto     
                            ));
    }
    
    /*
     * funcion para cambiar el estatus de envio/no envio de una orden
     */
    public function cambioEstadoEnvioOrden()
    {
        if(Request::ajax()){
                        
            $res = Orden::where('id', (int)$_POST['idOrden'])
                      ->update(array('cnEnviado' => (int)$_POST['cnEnviado']));
                        
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
    
    /**
     * Busca e imprime el listado de ordenes en un excel
     */
    public function exportarExcel()
    {        
        
        //obtenemos los registros que coincidan con los datos de busqueda          
        $listOrden = DB::table('cOrden')
            ->join('CarroCompra', 'cOrden.idCarroCompra', '=', 'CarroCompra.id')
            ->join('cEstatusVenta', 'cOrden.idEstatusVenta', '=', 'cEstatusVenta.id')
            ->join('cMoneda', 'CarroCompra.idMoneda', '=', 'cMoneda.id') 
            ->join('cCliente', 'cOrden.idCliente', '=', 'cCliente.id')
            ->select('cOrden.id', 'cEstatusVenta.dsEstatusVenta', 'cOrden.mnTransaccion','cMoneda.dsSimbolo',
                    'cCliente.dsNombre', 'cCliente.dsApellidoPaterno', 'cCliente.dsEmail')
            ->where('cOrden.idEstatusVenta', '=', (int)$_GET['idEstatusVentaSelected'])
            ->whereBetween('cOrden.created_at', array(
                                        date('Y-m-d',strtotime($_POST['fechaInicio']))." 00:00:00", 
                                        date('Y-m-d',strtotime($_POST['fechaFin']))." 23:59:59",))
            ->get();
        
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=reporteVentas/Ordenes_".date("d-m-Y",time()).".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
                               
        return View::make('Admin.listOrdenExcel', 
                        array( 
                                'listOrden' => $listOrden
                            ));
    }
}
?>