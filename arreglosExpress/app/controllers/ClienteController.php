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
    
    /*
     * mostrar informacion del cliente
     */
    public function clienteDetalle()
    {
        $idCliente = (int)$_GET['idCliente'];
        
        //obtener datos del cliente
        $Cliente = Cliente::find($idCliente);        
        //obtener direcciones del cliente
        $Direccion = Direccion::where("idCliente","=",$idCliente)->get();
        
         return View::make('Admin.detalleCliente',
                        array("Cliente" => $Cliente,
                              "Direccion" => $Direccion
                            ));
        
    }
    
    /*
     * actualizar / insertar datos del cliente
     */
    public function updateDatosCliente()
    {
        if(Request::ajax()){     
            
            $res = false;
            //evaluar accion
            if(trim($_POST['cmd'])=='add'){
                $res = $this->insert($_POST);
            }else{
                $res = $this->update($_POST);
            }
                            
            if($res){
                
                 //retornar listado de direcciones asociadas al cliente
                $idCliente = Session::get('idCliente');
                                
                $Direccion = Direccion::where("idCliente",'=',(int)$idCliente)->get();
//                print_r($Direccion);
                $listDireccion = array();
                $i=0;
                foreach($Direccion as $dir)
                {
                    $listDireccion[$i]['idDireccion'] = $dir->id;
                    $listDireccion[$i]['dsCiudad'] = $dir->dsCiudad;
                    $listDireccion[$i]['dsColonia'] = $dir->dsColonia;
                    $i++;
                }
                
                return Response::json(array(
                        'error' => 0,
                        'listDireccion' => $listDireccion
                    )); 
            }else{
                return Response::json(array(
                        'error' => 1,
                        'detalle' => 'ocurrio un error al intentar actualizar los datos'
                    )); 
            }
                      
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
    }
    
    private function update($data)
    {
        $Cliente = Cliente::find((int)$data['idCliente']);//idCliente
        $Cliente->dsNombre = trim($data['txtNombre']);
        $Cliente->dsApellidoPaterno = trim($data['txtApellidoPaterno']);
        $Cliente->dsApellidoMaterno = trim($data['txtApellidoMaterno']);
        $Cliente->dsEmail = trim($data['txtEmail']);
        
        $res = $Cliente->save();
        
        //guardar en session idCliente
         Session::put('idCliente', (int)$data['idCliente']);
        
        if((int)$res == 1){//UPDATE ok     
            return true;
        }else{
            return false;
        }
    }
    
    private function insert($data)
    {
        $Cliente = new Cliente;
        $Cliente->dsNombre = trim($data['txtNombre']);
        $Cliente->dsApellidoPaterno = trim($data['txtApellidoPaterno']);
        $Cliente->dsApellidoMaterno = trim($data['txtApellidoMaterno']);
        $Cliente->dsEmail = trim($data['txtEmail']);

        $res = $Cliente->save();
        //guardar en session idCliente
         Session::put('idCliente', $Cliente->id);

        if((int)$res == 1){//insert ok     
            return true;
        }else{
            return false;
        }
    }
}
?>