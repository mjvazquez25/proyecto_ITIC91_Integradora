
@extends('layouts.master2')

@section('content')

        
    <h1>Resumen de Compra! </h1>
    <br/>
     <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
            <tr bgcolor="#399"  style="color:white"> 
                <th  align='center'>
                    Datos Cliente
                </th>
            </tr>
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">Nombre: &nbsp;</strong>
                    <label>{{$Cliente->dsNombre. ' '.$Cliente->dsApellidoPaterno.' '.$Cliente->dsApellidoMaterno}}</label>
                </td>
            </tr>
             <tr>
                <td align="left">
                    <strong class="lblDescripcion">Email: &nbsp;</strong>
                    <label>{{$Cliente->dsEmail}}</label>
                </td>
            </tr>
            <tr bgcolor="#399"  style="color:white"> 
                <th  align='center'>
                    Direcci&oacute;n de env&iacute;o
                </th>
            </tr>
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">Ciudad: &nbsp;</strong>
                    <label>{{$Direccion->dsCiudad}}</label>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">Colonia: &nbsp;</strong>
                    <label>{{$Direccion->dsColonia}}</label>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">Calle: &nbsp;</strong>
                    <label>{{$Direccion->dsCalle}}</label>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">Codigo Postal: &nbsp;</strong>
                    <label>{{$Direccion->dsCodigoPostal}}</label>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">Telefono: &nbsp;</strong>
                    <label>{{$Direccion->dsTelefono}}</label>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">Celular: &nbsp;</strong>
                    <label>{{$Direccion->dsTelefonoMobile}}</label>
                </td>
            </tr>
            <tr bgcolor="#399"  style="color:white"> 
                <th  align='center'>
                    Productos del carrito
                </th>
            </tr>
            <tr>
                <td>
                    <table style=" width: 70%" border="0">
                        <tr>
                            <th>Cantidad</th>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th></th>
                        </tr>
                        @if (count($listProducto) > 0)
                            @foreach($listProducto as $car)
                                <tr>                    
                                    <td align="center">                                        
                                        <label>{{$car['noCantidad']}}</label> &nbsp;&nbsp;
                                    </td>
                                    <td align="center">
                                        <label>{{$car['dsNombre']}}</label> &nbsp;&nbsp;
                                    </td>
                                    <td align="center">
                                         <label>$ {{$car['noPrecio']}} MXN</label> &nbsp;&nbsp;
                                    </td>
                                    <td align="center">
                                         <img width='100' height='100' src="uploadImg/{{$Producto->getUrlImagen($car['idProducto'])}}">
                                    </td>
                                </tr>
                            @endforeach 
                        @endif    
                        <tr>                    
                            <td align="left" colspan="4">
                                <strong class="lblDescripcion" style='font-size:17px'>Total a pagar: $ {{$noTotal}} MXN</strong><br/>  
                            </td>
                        </tr>                        
                    </table>                     
               </td>
            </tr>
            <tr>                    
                <td align="center">
                    <input type="button" id="btnContinuar" value="Pagar" onclick="location.href='CreaFormularioDePago'" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
     </table>
    
@stop