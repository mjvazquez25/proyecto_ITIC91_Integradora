<?php 
class Producto extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cProducto';
    
    /*
     * Obtener listado de productos mediante filtros
     */
    public function getListByFiltro($data)
    {        
        $listProducto = DB::table('cProducto')
                    ->where('dsNombre', 'like', '%'.trim($data['dsNombreProducto']).'%')
                    ->where('cnActivo',1)
                    ->whereBetween('created_at', array(
                                            date('Y-m-d',strtotime($data['fechaInicio']))." 00:00:00", 
                                            date('Y-m-d',strtotime($data['fechaFin']))." 23:59:59",)
                            )
                    ->get();
        
        
        return $listProducto;
    }
    
    /*
     * devuelve la url del producto
     */
    public function getUrlImagen($idProducto)
    {        
        
        $urlImagen = DB::table('cProductoImagen')
                    ->where('idProducto', '=', (int)$idProducto)
                    ->where('cnVisible',  '=', 1)
                    ->get();
        
        $url = '';
        foreach($urlImagen as $img){
            $url = $img->dsRuta;
            break;
        }
        
        return $url;
    }
    
}
?>