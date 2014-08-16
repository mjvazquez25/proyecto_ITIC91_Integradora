
@extends('layouts.master2')

@section('content')

    {{ HTML::script('js/jquery.blockUI.js'); }}
    {{ HTML::style('css/listAdmin.css'); }}
    
    <h1>Historial Cliente</h1>
    <br/>
    <!-- pintar resultado -->
    <table cellpadding="2" cellspacing="2" id="dataTable" border="0" class="display">
        <thead>
		<tr bgcolor="#399">
                    <th>Orden</th>
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
                           <td align="center"><font face='verdana' size='1'>{{$orden->dsNombre. ' ' .$orden->dsApellidoPaterno}}</font></td>         
                           <td align="center"><font face='verdana' size='1'>{{$orden->dsEmail}}</font></td>       
                           <td align="center"><font face='verdana' size='2'>$ {{ number_format($orden->mnTransaccion,2,'.','') }} {{$orden->dsSimbolo}}</font></td>                     
                           <td align="center"><font face='verdana' size='1'><img border="0" style="cursor:pointer" idOrden="{{$orden->id}}" onclick="location.href='DetalleOrden?idOrden={{$orden->id}}'" class="btnEditar" title="Ver Detalle" src="img/editar.jpg"/></font></td>                           
                       </tr> 
                 @endforeach 
            @endif                                      
        </tbody>
    </table>
    <br/>
@stop