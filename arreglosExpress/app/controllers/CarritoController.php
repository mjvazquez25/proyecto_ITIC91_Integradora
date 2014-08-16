<?php

class CarritoController extends BaseController {
 
    /**
     * Agregar / Quitar elemento del carrito
     */
    public function UpdateCarrito()
    {
        if(Request::ajax()){
            
            $todoOk = false;
            //verificar si ya existe un carrito creado
            if (Session::has('idCarroCompra'))
            {
                $todoOk = $this->updateCarroCompraProducto((int)$_POST['idProducto'],(int)$_POST['flagAgrega']);
            }else{//si no, crear nuevo carrito y guardar id de carrito en session               
                
                $CarroCompra = new CarroCompra;
                $CarroCompra->idCliente = 1; //valores por default al crear un nuevo carrito
                $CarroCompra->idDireccion = 1;
                $CarroCompra->idMoneda = 1;

                $res = $CarroCompra->save();

                if((int)$res == 1){//insert ok     
                    //print_r($CarroCompra->id);
                    Session::put('idCarroCompra', $CarroCompra->id);
                    
                    $todoOk = $this->updateCarroCompraProducto((int)$_POST['idProducto'],(int)$_POST['flagAgrega']);   
                }
            }
                          
            if($todoOk){//actualizacion ok                
                return Response::json(array(
			    'error' => 0,
                            'listproducto' => $this->getProductoInCarrito()
			));                 
            }else{//error en la actualizaion
                return Response::json(array(
			    'error' => 1,
			    'detalle' => 'No se pudo actualizar el carrito!'
			)); 
            }            
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
    }
    
    /*
     * verificar si el correo ya esta registrado, 
     * si la respuesta es true => devolver todos los datos del cliente
     */
    
    public function verificaCorreoCliente()
    {
        if(Request::ajax()){     
            
            $dsCorreo = trim($_POST['dsCorreoElectronico']);
            
            $Cliente = Cliente::where("dsEmail","=",$dsCorreo)->get();
                        
            $cnExiste = 0;
            $dataCliente = array();
            if(count($Cliente)>0){
                $i=0;
                foreach($Cliente as $client){
                    $dataCliente[$i]['idCliente'] = $client->id;
                    $dataCliente[$i]['dsNombre'] = $client->dsNombre;
                    $dataCliente[$i]['dsApellidoPaterno'] = $client->dsApellidoPaterno;
                    $dataCliente[$i]['dsApellidoMaterno'] = $client->dsApellidoMaterno;
                    $dataCliente[$i]['dsApellidoMaterno'] = $client->dsApellidoMaterno;
                    break;
                }
                
                $cnExiste = 1;
            }
            
            return Response::json(array(
                        'error' => 0,
                        'cnExiste' => $cnExiste,
                        'dataCliente' => $dataCliente
                    ));           
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
    }
    
    /*
     * retorna listado de productos, cuando es una peticion ajax
     */
    public function getCarrito()
    {
        if(Request::ajax()){     
            return Response::json(array(
                        'error' => 0,
                        'listproducto' => $this->getProductoInCarrito()
                    ));           
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
    }
    
    /*
     * muestra el detalle de la compra
     */
    public function DetalleCompra()
    {
        $listProducto = $this->getProductoInCarrito();
        $Producto = new Producto();
        
        $noTotal = 0;
        
        //hacer sumatoria precio
        foreach($listProducto as $item)
        {
            $noTotal += $item['noPrecio'];
        }
        
        $noTotal = number_format($noTotal);
        
        //pasar los parametros a la vista
        return View::make('public.detallecompra', 
                        array( 
                                'listproducto' => $listProducto,
                                'Producto' => $Producto,
                                'noTotal' => $noTotal
                            ));
    }
    
    /*
     * solicitar datos del cliente
     */
    public function DatosCliente()
    {        
        
        return View::make('public.datoscliente', 
                        array( 
                            ));
    }
    
    /*
     * vista de paypal pago satisfactorio
     */
    public function PaypalResponse()
    {        
        //eliminar variables de sesion
        Session::forget('idCarroCompra');
        Session::forget('idDireccion');
//        Session::forget('idCliente');
        
        return View::make('public.paypalresponse', 
                        array( 
                            ));
    }
    
    /*
     * vista de pago paypal.. redirecionar a paypal pruebas
     */
    public function CreaFormularioDePago()
    {
        /*
         * obtener datos del cliente
         */        
        $idCliente = Session::get('idCliente');
        $Cliente = Cliente::find((int)$idCliente); 
        
        /*
         * obtener direccion de envio
         */
        $idDireccion = Session::get('idDireccion');
        $Direccion = Direccion::find((int)$idDireccion);
                
        /*
         * obtener productos en carrito
         */
        $listProductos = $this->getProductoInCarrito();
        
        $noTotal = 0;
        
        //hacer sumatoria precio
        foreach($listProductos as $item)
        {
            $noTotal += $item['noPrecio'];
        }
        
        $noTotal = number_format($noTotal);
        
        $idCarroCompra = Session::get('idCarroCompra');
        $paginaRetorno = basename($_SERVER[ "PHP_SELF"]);                             
//        echo Request::url();
//        die();
        return View::make('public.paypalpre', 
                        array( 
                            'Cliente' => $Cliente,
                            'Direccion' => $Direccion,
                            'listProducto' => $listProductos,
                            'noTotal' => number_format($noTotal,2),
                            'idCarroCompra' => (int)$idCarroCompra
                            ));
    }
    
    
    /*
     * pintar resumen de compra
     */
    public function ResumenPedido()
    {   
        /*
         * obtener datos del cliente
         */        
        $idCliente = Session::get('idCliente');
        $Cliente = Cliente::find((int)$idCliente); 
        
        /*
         * obtener direccion de envio
         */
        $idDireccion = Session::get('idDireccion');
        $Direccion = Direccion::find((int)$idDireccion);
                
        /*
         * obtener productos en carrito
         */
        $listProductos = $this->getProductoInCarrito();
//        print_r($listProductos); die();
        $Producto = new Producto();
        
         $noTotal = 0;
        
        //hacer sumatoria precio
        foreach($listProductos as $item)
        {
            $noTotal += $item['noPrecio'];
        }
        
        $noTotal = number_format($noTotal);
        
        return View::make('public.resumencompra', 
                        array( 
                            'Cliente' => $Cliente,
                            'Direccion' => $Direccion,
                            'listProducto' => $listProductos,
                            'Producto' => $Producto,
                            'noTotal' => number_format($noTotal,2)
                            ));
    }
    
    /*
     * validacion de pago paypal
     */
    public function validationPaypal()
    {
//        $from = "customerservice@arreglosexpress.velozservers.com"; // sender
//            $subject = "Prueba";
//            $message = "Mensaje de prueba:: Llego al metodo";
//            // message lines should not exceed 70 characters (PHP rule), so wrap it
//            $message = wordwrap($message, 70);
//            // send mail
//            mail("manuel_ca7@outlook.com",$subject,$message,"From: $from\n");
            
        $errors = '';
        $result = false;

        // Fill params
        $params = 'cmd=_notify-validate';
        foreach ($_POST AS $key => $value)
                $params .= '&'.$key.'='.urlencode(stripslashes($value));

        // PayPal Server
        $paypalServer = 'www.sandbox.paypal.com';//pruebas
//        $paypalServer = 'www.paypal.com';//live

        // Getting PayPal data...
        if (function_exists('curl_exec'))
        {
                // curl ready
                $ch = curl_init('https://' . $paypalServer . '/cgi-bin/webscr');

                // If the above fails, then try the url with a trailing slash (fixes problems on some servers)
                if (!$ch)
                        $ch = curl_init('https://' . $paypalServer . '/cgi-bin/webscr/');

                if (!$ch)
                        $errors .= "error de conexion";
                else
                {
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HEADER, false);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        $result = curl_exec($ch);
                        if (strtoupper($result) != 'VERIFIED')
                                $errors .= $result.' cURL error:'.curl_error($ch);
                        curl_close($ch);
                }
        }
        elseif (($fp = @fsockopen('ssl://' . $paypalServer, 443, $errno, $errstr, 30)) || ($fp = @fsockopen($paypalServer, 80, $errno, $errstr, 30)))
        {
                // fsockopen ready
                $header = 'POST /cgi-bin/webscr HTTP/1.0'."\r\n" .
                  'Host: '.$paypalServer."\r\n".
                  'Content-Type: application/x-www-form-urlencoded'."\r\n".
                  'Content-Length: '.Tools::strlen($params)."\r\n".
                  'Connection: close'."\r\n\r\n";
                fputs($fp, $header.$params);

                $read = '';
                while (!feof($fp))
                {
                        $reading = trim(fgets($fp, 1024));
                        $read .= $reading;
                        if (strtoupper($reading) == 'VERIFIED' OR strtoupper($reading) == 'INVALID')
                        {
                                $result = $reading;
                                break;
                        }
                }
                if (strtoupper($result) != 'VERIFIED')
                        $errors .= $result;
                fclose($fp);
        }

        //Transaccion OK
        if (strtoupper($result) == 'VERIFIED')
        {
            //si llega aqui todo ok
            /*
             * insertar registro de pago y venta
             */            
            $idCarroCompra = (int)$_POST['custom'];
        
            $CarroCompra = CarroCompra::find((int)$idCarroCompra); 
            $Cliente = Cliente::find((int)$CarroCompra->idCliente);
        
            //guardar orden
            $Orden = new Orden;
            $Orden->mnTransaccion = (float)($_POST['mc_gross']);
            $Orden->noTipoCambio = 13; //obsoleto -- por default 13
            $Orden->idCarroCompra = (int)$idCarroCompra;
            $Orden->idCliente = (int)$CarroCompra->idCliente;
            $Orden->idEstatusVenta = 1;//pagada
            $Orden->idIdioma = 1;//por default 1
            $Orden->save();

            //insertar pago
            $Pago = new Pago;
            $Pago->noImporte = (float)($_POST['mc_gross']);
            $Pago->dsIdentificadorPagoPaypal = trim($_POST['txn_id']);
            $Pago->dsMonedaPago = trim($_POST['mc_currency']);
            $Pago->dsCorreoComprador = trim($_POST['payer_email']);
            $Pago->idMoneda = 1;//por default 1
            $Pago->idOrden = (int)$Orden->id;
            $Pago->idEstatusPago =  1; //1 aprovado
            $Pago->save();
            
           // enviar correo de notificacion al cliente            
            $from = "customerservice@arreglosexpress.velozservers.com"; // sender
            $subject = "Compra Exitosa!. Arreglos Express";
            $message = "COMPRA EXITOSA! <br> \n";
            $message .= "Gracias por comprar con nosotros! <br> \n";
            $message .= "Su pedido sera enviado lo mas pronto posible. <br> \n";
            $message .= "Puede ver el detalle de su compra ingresando a nuestra pagina: http://arreglosexpress.velozservers.com/public/Historial <br> \n";
            $message .= "CLIENTE: ".$Cliente->dsNombre." ".$Cliente->dsApellidoPaterno." <br> \n";
            $message .= "FOLIO COMPRA: ".(int)$Orden->id." <br> \n";
            // message lines should not exceed 70 characters (PHP rule), so wrap it
            $body = wordwrap($message, 70);
            // send mail
            mail($Cliente->dsEmail,$subject,$body,"From: $from\n");
            
        }else{            
            /*
             * //pago no aceptado
             */
            $idCarroCompra = (int)$_POST['custom'];
        
            $CarroCompra = CarroCompra::find((int)$idCarroCompra); 
            $Cliente = Cliente::find((int)$CarroCompra->idCliente);
        
            //guardar orden
            $Orden = new Orden;
            $Orden->mnTransaccion = (float)($_POST['mc_gross']);
            $Orden->noTipoCambio = 13; //obsoleto -- por default 13
            $Orden->idCarroCompra = (int)$idCarroCompra;
            $Orden->idCliente = (int)$CarroCompra->idCliente;
            $Orden->idEstatusVenta = 2;//pagada
            $Orden->idIdioma = 1;//por default 1
            $Orden->save();

            //insertar pago
            $Pago = new Pago;
            $Pago->noImporte = (float)($_POST['mc_gross']);
            $Pago->dsIdentificadorPagoPaypal = trim($_POST['txn_id']);
            $Pago->dsMonedaPago = trim($_POST['mc_currency']);
            $Pago->dsCorreoComprador = trim($_POST['payer_email']);
            $Pago->idMoneda = 1;//por default 1
            $Pago->idOrden = (int)$Orden->id;
            $Pago->idEstatusPago =  2; //1 aprovado
            $Pago->save();
//            $from = "customerservice@arreglosexpress.velozservers.com"; // sender
//            $subject = "Prueba";
//            $message = "Mensaje de prueba :: pago no aceptado";
//            // message lines should not exceed 70 characters (PHP rule), so wrap it
//            $message = wordwrap($message, 70);
//            // send mail
//            mail("manuel_ca7@outlook.com",$subject,$message,"From: $from\n");
        }
    }
    
    /*
     * actualizar los datos del carrito
     * asignar id direccion de envio y guardar id en sesion
     */
    public function guardaDireccionCarrito()
    {        
        if(Request::ajax()){     
            
            $idDireccion = (int)$_POST['idDireccion'];
            Session::put('idDireccion', $idDireccion);

            //actualizar carrito
             if (Session::has('idCarroCompra'))
             {
                 $idCarroCompra = Session::get('idCarroCompra');
                 $idCliente = Session::get('idCliente');
                 
                 $res = CarroCompra::where('id', (int)$idCarroCompra)
                      ->update(array('idDireccion' => (int)$idDireccion, 'idCliente'=>(int)$idCliente));
                        
                if((int)$res == 1){//actualizacion ok                
                    return Response::json(array(
                                'error' => 0
                            ));                 
                }else{//error en la actualizaion
                    return Response::json(array(
                                'error' => 1,
                                'detalle' => 'No se puedo actualizar el registro'
                            )); 
                }  
                 
             }else{
              return Response::json(array(
                        'error' => 1,
                        'detalle' =>'No existe el carrito, por favor regrese al paso 1'
                    ));    
             }                      
        }else{
            return Response::json(array(//no es ajax
			    'error' => 1,
			    'detalle' => 'peticion no valida'
			)); 
        }
    }
            
    /*
     * eliminar o insertar registros en el carrito de compra
     */
    private function updateCarroCompraProducto($idProducto,$flagAgrega)
    {
        $idCarroCompra = Session::get('idCarroCompra');
        //revisar si existe un carro compra producto asociado
        $existeCarroCompraProducto = DB::table('CarroCompraProducto')
                    ->where("idCarroCompra",'=',(int)$idCarroCompra)
                    ->where('idProducto','=',(int)$idProducto)
                    ->get();
        
       if(count($existeCarroCompraProducto)>0){
           
            //checar flag
           if((int)$flagAgrega==1){//ya existe el registro
               return true;
           }else{//eliminar
               DB::table('CarroCompraProducto')
                       ->where("idCarroCompra",'=',(int)$idCarroCompra)
                       ->where('idProducto','=',(int)$idProducto)
                       ->delete();
               
               return true;
           }
       }else{
           
           //checar flag
           if((int)$flagAgrega==1){
               //insertar producto al carrito
               $CarroCompraProducto = new CarroCompraProducto;
               $CarroCompraProducto->noCantidad = 1;
               $CarroCompraProducto->idProducto = (int)$idProducto;
               $CarroCompraProducto->idCarroCompra = (int)$idCarroCompra;
               
               $res = $CarroCompraProducto->save();
               if((int)$res == 1){//insert ok     
                    return true;
               }else{
                   return false;
               }                
           }else{//no hacer nada
               return true;
           }
       }
        
    }
    
    /*
     * obtener listado de productos guardados en el carrito 
     */
    private function getProductoInCarrito()
    {
        $idCarroCompra = Session::get('idCarroCompra');
        
        $listCarroCompraSource = DB::table('CarroCompra')
            ->join('CarroCompraProducto', 'CarroCompra.id', '=', 'CarroCompraProducto.idCarroCompra')
            ->join('cProducto', 'CarroCompraProducto.idProducto', '=', 'cProducto.id')
            ->select('CarroCompraProducto.id as idcp','CarroCompraProducto.noCantidad','cProducto.dsNombre','cProducto.noPrecio','cProducto.id')
            ->where('CarroCompra.id','=',(int)$idCarroCompra)
            ->get();
        
        $listCarroCompra = array();
        
        $i = 0;
        foreach($listCarroCompraSource as $car){
            $listCarroCompra[$i]['idCarroCompraProducto'] =  $car->idcp;
            $listCarroCompra[$i]['idProducto'] =  $car->id;
            $listCarroCompra[$i]['noCantidad'] =  $car->noCantidad;
            $listCarroCompra[$i]['dsNombre'] =  $car->dsNombre;
            $listCarroCompra[$i]['noPrecio'] =  $car->noPrecio;
            $i++;
        }
        
        return $listCarroCompra;
    }
}
?>

