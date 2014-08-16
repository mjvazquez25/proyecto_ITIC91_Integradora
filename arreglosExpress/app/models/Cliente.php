<?php 
class Cliente extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cCliente';
    
    /*
     * Obtener listado de productos mediante filtros
     */
    public function getListByFiltro($data)
    {        
        $listCliente = DB::table('cCliente')
                    ->where('dsNombre', 'like', '%'.trim($data['dsNombre']).'%')
                    ->where('dsEmail', 'like', '%'.trim($data['dsEmail']).'%')
                    ->get();
        
        
        return $listCliente;
    }
    
}
?>