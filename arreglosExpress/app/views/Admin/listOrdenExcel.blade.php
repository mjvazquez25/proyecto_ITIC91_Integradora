    <h2>Reporte de Ventas :: Arreglos Express</h2>
    <br/>
    <!-- pintar resultado -->
    <table cellpadding="2" cellspacing="2" id="dataTable" border="1" class="display">
        <thead>
		<tr bgcolor="#399">
                    <th>Orden</th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Importe</th>      
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
                       </tr> 
                 @endforeach 
            @endif                                      
        </tbody>
    </table>
