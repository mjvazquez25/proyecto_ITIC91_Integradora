<?php

class HistorialController extends BaseController {

    public function showHistorial()
    {            
         if (Session::has('idCliente')){
             //mostrar historial
              $idCliente = Session::get('idCliente');
              $listOrden = $this->getHistorial($idCliente);
                            
               return View::make('public.showHistorial', 
                        array( 
                            'listOrden' => $listOrden
                            ));
         }else{
             //solicitar correo electronico del usuario
             return View::make('public.historialByCorreo', 
                        array( 
                            ));
         }
    }
    
    public function showHistorialById()
    {
        $idCliente = (int)trim($_GET['idCliente']);
        
        $listOrden = $this->getHistorial($idCliente);
        
        //mostrar historial
        return View::make('public.showHistorial', 
                        array( 
                            'listOrden' => $listOrden
                            ));
        
    }
    
    private function getHistorial($idCliente)
    {
        $listOrden = DB::table('cOrden')
            ->join('CarroCompra', 'cOrden.idCarroCompra', '=', 'CarroCompra.id')
            ->join('cEstatusVenta', 'cOrden.idEstatusVenta', '=', 'cEstatusVenta.id')
            ->join('cMoneda', 'CarroCompra.idMoneda', '=', 'cMoneda.id') 
            ->join('cCliente', 'cOrden.idCliente', '=', 'cCliente.id')
            ->select('cOrden.id', 'cEstatusVenta.dsEstatusVenta', 'cOrden.mnTransaccion','cMoneda.dsSimbolo',
                    'cCliente.dsNombre', 'cCliente.dsApellidoPaterno', 'cCliente.dsEmail')
            ->where('cOrden.idCliente','=',$idCliente)
            ->get();
        
        return $listOrden;
    }
    
    public function DetalleOrden()
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
        
        //obtener carrito de compra
        $Carrito = DB::table('CarroCompraProducto')
            ->join('cProducto', 'CarroCompraProducto.idProducto', '=', 'cProducto.id')
            ->join('CarroCompra', 'CarroCompraProducto.idCarroCompra', '=', 'CarroCompra.id')
            ->join('cOrden', 'cOrden.idCarroCompra', '=', 'CarroCompra.id')
            ->select('cProducto.dsNombre', 'CarroCompraProducto.noCantidad','cProducto.id')
            ->where('cOrden.id','=',$idOrden)
            ->get();
        
        $Producto = new Producto();
        
         return View::make('public.verOrden',
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

}

