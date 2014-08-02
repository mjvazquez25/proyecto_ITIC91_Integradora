<?php 
class GaleriaController extends BaseController {
 
    /**
     * Obtienes los productos de la BD
     */
    public function displayProductos()
    { 
        //obtener listado de productos        
        $listProducto = DB::table('cproducto')
            ->join('cproductoimagen', 'cproducto.id', '=', 'cproductoimagen.idProducto')
            ->select('cproducto.id','cproducto.dsNombre','cproducto.dsDescripcion','cproducto.noPrecio','cproductoimagen.dsRuta')
            ->where('cproductoimagen.cnVisible', '=',1)
            ->where('cproducto.noStock', '>',0)
            ->where('cproducto.cnActivo', '=',1)
            ->get();
        
        //pasar los parametros a la vista
        return View::make('public.galeria', 
                        array( 
                                'listProducto' => $listProducto,
                                'toptd' =>  0,
//                                '$count' => 0
                            ));
    }
    
}
?>
