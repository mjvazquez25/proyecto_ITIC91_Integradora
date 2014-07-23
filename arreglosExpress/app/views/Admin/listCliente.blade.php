@extends('layouts.masterAdmin')

@section('content')

    {{ HTML::script('js/Admin/listCliente.js'); }}
    {{ HTML::script('js/jquery.blockUI.js'); }}
    
    <!-- <div style="margin-top:5px;">    -->
        <h1 style="text-align:center">Listado de Clientes</h1>        
    <!-- </div> -->
    
    <!-- filtro de busqueda productos -->
    <div id="frmBusqueda">
        <form name="frmBuscaCliente" id="frmBuscaCliente" action="" method="post">
            <table cellspacing='2' cellpadding='2' border='0' align="center">
                <tr>
                    <td>
                        <font>Nombre:</font>
                        <input type="text" value="{{$dsNombre}}" id="dsNombre" name="dsNombre" size="30" />
                    </td>
                    <td>
                        <font>Correo:</font>
                        <input type="text" value="{{$dsEmail}}" id="dsEmail" name="dsEmail" size="30" />
                    </td>
                     <td align="right">
                        <input type="submit" id="aceptar" class="acepto" value="Buscar" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
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
                    <th>Nombre</th>
                    <th>Email</th>                    
                    <th></th>
		</tr>
	</thead>
	<tbody>
             @if (count($listCliente) > 0)
                @foreach($listCliente as $cliente)
                       <tr>                            
                           <td align="center"><font face='verdana' size='1'>{{$cliente->dsNombre.' '.$cliente->dsApellidoPaterno.' '.$cliente->dsApellidoMaterno}}</font></td>                                                                                            
                           <td align="center"><font face='verdana' size='1'>{{$cliente->dsEmail}}</font></td>                         
                           <td align="center"><font face='verdana' size='1'><img border="0" style="cursor:pointer" idCliente="{{$cliente->id}}" class="btnVerDetalle" title="Ver Detalle" src="img/editar.jpg"/></font></td>
                           
                       </tr> 
                 @endforeach 
            @endif       
        </tbody>
    </table>
@stop
