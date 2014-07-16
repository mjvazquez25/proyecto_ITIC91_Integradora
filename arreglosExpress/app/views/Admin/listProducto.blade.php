@extends('layouts.masterAdmin')

@section('content')

    {{ HTML::script('js/Admin/listProducto.js'); }}
    <!-- <div style="margin-top:5px;">    -->
        <h1 style="text-align:center">Listado de productos</h1>        
    <!-- </div> -->
    
    <!-- filtro de busqueda productos -->
    <div id="frmBusqueda">
        <form name="frmBuscaProducto" id="frmBuscaProducto" action="" method="post">
            <table cellspacing='2' cellpadding='2' border='0' align="center">
                <tr>
                    <td>
                        <font>Producto:</font>
                        <input type="text" value="" id="dsNombreProducto" name="dsNombreProducto" size="30" />
                    </td>
                    <td>&nbsp;&nbsp;<font>Fecha Alta Producto:</font>
                        <input type="text" value="" size="10" name="fechaInicio" id="feInicio" readonly='readonly' />
                    </td>
                    <td>&nbsp;&nbsp;<font></font>
                        <input type="text" value="" size="10" name="fechaFin" id="feFin" readonly='readonly' />
                    </td>
                     <td align="right">
                        <input type="button" id="aceptar" class="acepto" value="Buscar" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <br/>
    
    <!-- pintar resultado -->
    <table cellpadding="2" cellspacing="2" id="dataTable" border="0" class="display">
        <thead>
		<tr bgcolor="#399">
                    <th>Producto</th>
                    <th>Descripcion</th>                        
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Activo</th>
		</tr>
	</thead>
	<tbody>
             @foreach($listProducto as $producto)
                <li>
                    <tr>                            
                        <td align="center"><font face='verdana' size='1'>{{$producto->dsNombre}}</font></td>                                                                                            
                        <td align="center"><font face='verdana' size='1'>{{$producto->dsDescripcion}}</font></td>
                        <td align="center"><font face='verdana' size='2'>{{$producto->noPrecio}}</font></td>
                        <td align="center"><font face='verdana' size='1'>{{$producto->noStock}}</font></td>
                        <td align="center"><font face='verdana' size='1'>{{$producto->cnActivo}}</font></td>
                    </tr> 
                </li>
              @endforeach 
                            
        </tbody>
    </table>
@stop
