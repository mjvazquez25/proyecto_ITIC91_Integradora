@extends('layouts.masterAdmin')

@section('content')
        
    {{ HTML::script('js/Admin/detalleOrden.js'); }}
    
    <!-- <div style="margin-top:5px;">    -->
        <h1 style="text-align:center">Detalle Orden</h1>        
    <!-- </div> -->
    <br/>
        <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
            <tr bgcolor="#01963A"  style="color:white"> 
                <th  align='center'>
                    Datos Cliente
                </th>
            </tr>
            <tr>                    
                <td align="left">
                    <strong class="lblDescripcion">Nombre: &nbsp;</strong>
                    <label>{{$Cliente->dsNombre. ' '.$Cliente->dsApellidoPaterno.' '.$Cliente->dsApellidoMaterno}}<label>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <strong class="lblDescripcion">Email: &nbsp;</strong>
                    <label>{{$Cliente->dsEmail}}<label>
                </td>
            </tr>
        </table>
@stop
