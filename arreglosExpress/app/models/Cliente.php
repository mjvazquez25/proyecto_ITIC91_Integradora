<?php 
class Cliente extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'ccliente';
    
    /*
     * Obtener listado de productos mediante filtros
     */
    /*public function getListByFiltro($data)
    {        
        $listProducto = DB::table('cproducto')
                    ->where('dsNombre', 'like', '%'.trim($data['dsNombreProducto']).'%')
                    ->where('cnActivo',1)
                    ->whereBetween('created_at', array(
                                            date('Y-m-d',strtotime($data['fechaInicio']))." 00:00:00", 
                                            date('Y-m-d',strtotime($data['fechaFin']))." 23:59:59",)
                            )
                    ->get();
        
        
        return $listProducto;
    }*/
    
}
?>