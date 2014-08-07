<?php 
class MensajeContactoController extends BaseController {
 
    /**
     * Muestra la lista con todos los msjs
     */
    public function listMensaje()
    { 
        //obtenemos todos los registros
        $listMensaje = MensajeContacto::all();    
        
        $diasAtras90 = time()-(180*24*60*60);
        $feIni =  date('Y-m-d',$diasAtras90);
        $feFin = date("Y-m-d", time());

        //pasar los parametros a la vista
        return View::make('Admin.listMensajeContacto', 
                        array( 'listMensaje' => $listMensaje,
                               'feIni' => $feIni,
                               'feFin' => $feFin,
                            ));
    }
    
    /**
     * Busca y retorna el listado de msjs mediante filtros
     */
    public function getListByFiltro()
    {        
        //obtenemos los registros de los clientes que coincidan con los datos de busqueda    
        $MensajeContacto = new MensajeContacto();
        $listMensaje = $MensajeContacto->getListByFiltro($_POST);
        
        //setear valores de los filtros
        $feIni =  date('Y-m-d', strtotime($_POST['fechaInicio']));
        $feFin = date("Y-m-d", strtotime($_POST['fechaFin']));
                       
        //pasar los parametros a la vista
        return View::make('Admin.listMensajeContacto',
                        array('listMensaje' => $listMensaje,
                              'feIni' => $feIni,
                              'feFin' => $feFin,
                            ));
    }    
    
    /*
     * retornar detalle del msj
     */
    public function mensajeDetalle()
    {   
        if(Request::ajax()){
                        
            $idMensaje = (int)$_POST['idMensaje'];        
            //obtener datos del msj
            $MesajeContacto = MensajeContacto::find($idMensaje); 
                        
            return Response::json(array(
                        'error' => 0,
                        'dsContenido' => $MesajeContacto->dsContenido,
                        'dsNombre' => $MesajeContacto->dsNombre . ' '. $MesajeContacto->dsApellido,
                        'dsEmail' => $MesajeContacto->dsEmail,
                        'dsTelefono' => $MesajeContacto->dsTelefono
                    )); 
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
        
    }
    
    /*
     * guardar nuevo mensaje de contacto
     */
    public function GuardaMensaje()
    {
        if(Request::ajax()){
                        
            $MensajeContacto = new MensajeContacto;
            $MensajeContacto->dsContenido = trim($_POST['txtComentario']);
            $MensajeContacto->dsNombre = trim($_POST['txtNombre']);
            $MensajeContacto->dsApellido = trim($_POST['txtApellido']);
            $MensajeContacto->dsEmail = trim($_POST['txtEmail']);
            $MensajeContacto->dsTelefono = trim($_POST['txtTelefono']);

            $res = $MensajeContacto->save();
                                    
            if((int)$res == 1){//insert ok                
                return Response::json(array(
			    'error' => 0,
                            'idMensaje' =>$MensajeContacto->id
			));                 
            }else{//error en la actualizaion
                return Response::json(array(
			    'error' => 1,
			    'detalle' => 'No se puede enviar el comentario'
			)); 
            }
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
        
    }
    
   
    
}
?>