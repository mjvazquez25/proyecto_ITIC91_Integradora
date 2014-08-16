<?php 
class GaleriaController extends BaseController {
 
    /**
     * Obtienes los productos de la BD
     */
    public function displayProductos()
    { 
        // El mensaje
//        $mensaje = "Línea 1\r\nLínea 2\r\nLínea 3";
//
//        // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
//        $mensaje = wordwrap($mensaje, 70, "\r\n");
//
//        // Enviarlo
//        $res = mail('manuel_ca7@outlook.com', 'Mi título', $mensaje);
//        print_r($res);
        
        //obtener listado de productos        
        $listProducto = DB::table('cProducto')
            ->join('cProductoImagen', 'cProducto.id', '=', 'cProductoImagen.idProducto')
            ->select('cProducto.id','cProducto.dsNombre','cProducto.dsDescripcion','cProducto.noPrecio','cProductoImagen.dsRuta')
            ->where('cProductoImagen.cnVisible', '=',1)
            ->where('cProducto.noStock', '>',0)
            ->where('cProducto.cnActivo', '=',1)
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
