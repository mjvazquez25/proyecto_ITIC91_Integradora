<?php 
class OrdenController extends BaseController {
 
    /**
     * Mustra la lista de todas las ordenes
     */
    public function listOrden()
    {
        $listOrden = Orden::all();        
        $listEstatusVenta = EstatusVenta::all();
        
        //setear valores de los campos de fecha -- por default 90 dias hacia atras
        $diasAtras90 = time()-(180*24*60*60);
        $feIni =  date('Y-m-d',$diasAtras90);
        $feFin = date("Y-m-d", time());
        
        return View::make('Admin.listOrden', 
                        array( 'listOrden' => $listOrden,
                               'listEstatusVenta' => $listEstatusVenta,
                               'feIni' => $feIni,
                               'feFin' => $feFin,
                            ));
    }
 
}
?>