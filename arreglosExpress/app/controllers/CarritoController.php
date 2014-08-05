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
                    print_r($CarroCompra->id);
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
     * eliminar o insertar registros en el carrito de compra
     */
    private function updateCarroCompraProducto($idProducto,$flagAgrega)
    {
        $idCarroCompra = Session::get('idCarroCompra');
        //revisar si existe un carro compra producto asociado
        $existeCarroCompraProducto = DB::table('carrocompraproducto')
                    ->where("idCarroCompra",'=',(int)$idCarroCompra)
                    ->where('idProducto','=',(int)$idProducto)
                    ->get();
        
       if(count($existeCarroCompraProducto)>0){
           
            //checar flag
           if((int)$flagAgrega==1){//ya existe el registro
               return true;
           }else{//eliminar
               DB::table('carrocompraproducto')
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
        
        $listCarroCompraSource = DB::table('carrocompra')
            ->join('carrocompraproducto', 'carrocompra.id', '=', 'carrocompraproducto.idCarroCompra')
            ->join('cproducto', 'carrocompraproducto.idProducto', '=', 'cproducto.id')
            ->select('carrocompraproducto.noCantidad','cproducto.dsNombre','cproducto.noPrecio','cproducto.id')
            ->where('carrocompra.id','=',(int)$idCarroCompra)
            ->get();
        
        $listCarroCompra = array();
        
        $i = 0;
        foreach($listCarroCompraSource as $car){
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

