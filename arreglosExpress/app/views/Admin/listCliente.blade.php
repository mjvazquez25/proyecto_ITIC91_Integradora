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
                        <input type="text" value="" id="dsNombreProducto" name="dsNombreProducto" size="30" />
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
                    <th>Precio</th>
                    <th>Stock</th>                    
                    <th colspan="2"></th>
		</tr>
	</thead>
	<tbody>
            <tr>
                <td>
                    aqui van todos los clientes
                </td>
            </tr>
        </tbody>
    </table>
@stop
