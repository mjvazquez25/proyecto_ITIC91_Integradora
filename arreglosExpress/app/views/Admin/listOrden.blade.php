@extends('layouts.masterAdmin')

@section('content')

    {{ HTML::script('js/Admin/listOrden.js'); }}
    {{ HTML::script('js/jquery.blockUI.js'); }}
    
    <!-- <div style="margin-top:5px;">    -->
        <h1 style="text-align:center">Listado de Ventas / Ordenes</h1>        
    <!-- </div> -->
    
    <!-- filtro de busqueda productos -->
    <div id="frmBusqueda">
        <form name="frmBuscaVenta" id="frmBuscaVenta" action="" method="post">
            <table cellspacing='2' cellpadding='2' border='0' align="center">
                <tr>
                    <td>
                        <font>Estatus:</font>
                        <select name="cmbEstatusVenta">
                            <!-- <option value="-1">Todos</option> -->
                              @if (count($listEstatusVenta) > 0)
                                @foreach($listEstatusVenta as $estatus)
                                <option value="{{$estatus->id}}">{{$estatus->dsEstatusVenta}}</option>
                                @endforeach 
                             @endif  
                        </select>
                    </td>
                    <td>&nbsp;&nbsp;<font>Fecha Transaccion:</font>
                        <input type="text" value="{{$feIni}}" size="10" name="fechaInicio" id="feInicio" readonly='readonly' />
                    </td>
                    <td>&nbsp;&nbsp;<font></font>
                        <input type="text" value="{{$feFin}}" size="10" name="fechaFin" id="feFin" readonly='readonly' />
                    </td>
                     <td align="right">
                        <input type="submit" id="aceptar" class="acepto" value="Buscar" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left">
                        <input type="button" feIni="{{$feIni}}" feFin="{{$feFin}}" id="btnExportarExcel" idEstatusVentaSelected="{{$EstatusVentaSelected}}" class="acepto" value="Exportar a Excel" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;                        
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
                    <th>Orden</th>
                    <th>Estatus</th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Importe</th>                
                    <th colspan="2"></th>
		</tr>
	</thead>
	<tbody>
            @if (count($listOrden) > 0)
                @foreach($listOrden as $orden)
                       <tr>                            
                           <td align="center"><font face='verdana' size='1'>{{$orden->id}}</font></td>                           
                           <td align="center"><font face='verdana' size='1'>{{$orden->dsEstatusVenta}}</font></td>       
                           <td align="center"><font face='verdana' size='1'>{{$orden->dsNombre. ' ' .$orden->dsApellidoPaterno}}</font></td>         
                           <td align="center"><font face='verdana' size='1'>{{$orden->dsEmail}}</font></td>       
                           <td align="center"><font face='verdana' size='2'>$ {{ number_format($orden->mnTransaccion,2,'.','') }} {{$orden->dsSimbolo}}</font></td>                     
                           <td align="center"><font face='verdana' size='1'><img border="0" style="cursor:pointer" idOrden="{{$orden->id}}" class="btnEditar" title="Editar" src="img/editar.jpg"/></font></td>                           
                       </tr> 
                 @endforeach 
            @endif                                      
        </tbody>
    </table>
@stop
