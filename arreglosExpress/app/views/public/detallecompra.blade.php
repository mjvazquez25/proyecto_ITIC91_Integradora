
@extends('layouts.master2')

@section('content')
    <h1>Detalle de Compra </h1>
    
    <br/>
     <form id="frmDetalleCompra">
        <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">productos seleccionados:</strong><br/>                    
                </td>
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
                        @if (count($listproducto) > 0)
                            @foreach($listproducto as $car)
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
                                <strong class="lblDescripcion" style='font-size:17px'>Total: $ {{$noTotal}} MXN</strong><br/>  
                            </td>
                        </tr>
                    </table>                    
               </td>
            </tr>            
            <tr>                    
                <td align="center">
                    <input type="button" id="btnContinuar" value="Continuar" onclick="location.href='DatosCliente'" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </form>
@stop