<?php 
class MensajeContacto extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'MensajeContacto';
    
    /*
     * Obtener listado de msjs mediante filtros
     */
    public function getListByFiltro($data)
    {        
        $listMensaje = DB::table('MensajeContacto')
                    ->whereBetween('created_at', array(
                                            date('Y-m-d',strtotime($data['fechaInicio']))." 00:00:00", 
                                            date('Y-m-d',strtotime($data['fechaFin']))." 23:59:59",)
                            )
                    ->get();
        
        
        return $listMensaje;
    }
    
}
?>