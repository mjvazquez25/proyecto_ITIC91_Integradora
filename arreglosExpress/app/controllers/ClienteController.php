<?php 
class ClienteController extends BaseController {
 
    /**
     * Muestra la lista con todos los clientes
     */
    public function listCliente()
    { 
        //obtenemos los registros de los clientes guardados en la bd
        $listCliente = Cliente::all();       

        //pasar los parametros a la vista
        return View::make('Admin.listCliente', 
                        array( 'listCliente' => $listCliente,
                               'dsNombre' => '',
                               'dsEmail' => '',
                            ));
    }
    
    /**
     * Busca y retorna el listado de clientes mediante filtros
     */
    public function getListByFiltro()
    {        
        //obtenemos los registros de los clientes que coincidan con los datos de busqueda    
        $Cliente = new Cliente();
        $listCliente = $Cliente->getListByFiltro($_POST);
        
        //setear valores de los filtros
        $dsNombre = trim($_POST['dsNombre']);
        $dsEmail = trim($_POST['dsEmail']);
                       
        //pasar los parametros a la vista
        return View::make('Admin.listCliente',
                        array('listCliente' => $listCliente,
                              'dsNombre' => $dsNombre,
                              'dsEmail' => $dsEmail
                            ));
    }
 
}
?>