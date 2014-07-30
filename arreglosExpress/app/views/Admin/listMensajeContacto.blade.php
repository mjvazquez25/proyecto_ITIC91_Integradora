@extends('layouts.masterAdmin')

@section('content')

    {{ HTML::script('js/Admin/listMensajeContacto.js'); }}
    {{ HTML::script('js/jquery.blockUI.js'); }}
    
    <!-- <div style="margin-top:5px;">    -->
        <h1 style="text-align:center">Listado de Mensajes</h1>        
    <!-- </div> -->
    
    <!-- div para mostrar detalle de msj -->
    <div id="windowDetalleMsj" style="display:none">
    <fieldset>
            <p>
                <strong>Remitente: &nbsp;</strong>
                <label id="lblRemitente"></label>
                <br/>
            </p>
            <p>
                <strong>Email: &nbsp;</strong>
                <label id="lblEmail"></label>
                <br/>
            </p>
            <p>
                <strong>Telefono: &nbsp;</strong>
                <label id="lblTelefono"></label>
                <br/>
            </p>
            <p>
                <strong>Mensaje: &nbsp;</strong>
                <label id="lblMensaje"></label>
                <br/>
            </p>
    </fieldset>
</div>
    
    <!-- filtro de busqueda productos -->
    <div id="frmBusqueda">
        <form name="frmBuscaMensaje" id="frmBuscaMensaje" action="" method="post">
            <table cellspacing='2' cellpadding='2' border='0' align="center">
                <tr>
                    <td>&nbsp;&nbsp;<font>Fecha Registro:</font>
                        <input type="text" value="{{$feIni}}" size="10" name="fechaInicio" id="feInicio" readonly='readonly' />
                    </td>
                    <td>&nbsp;&nbsp;<font></font>
                        <input type="text" value="{{$feFin}}" size="10" name="fechaFin" id="feFin" readonly='readonly' />
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
                    <th>Telefono</th>
                    <th>Mensaje</th>                    
                    <th></th>
		</tr>
	</thead>
	<tbody>
            @if (count($listMensaje) > 0)
                @foreach($listMensaje as $msj)
                       <tr>                            
                           <td align="center"><font face='verdana' size='1'>{{$msj->dsNombre. ' '. $msj->dsApellido}}</font></td>                                                                                            
                           <td align="center"><font face='verdana' size='2'>{{$msj->dsEmail }}</font></td>
                           <td align="center"><font face='verdana' size='1'>{{$msj->dsTelefono}}</font></td>   
                           <td align="center"><font face='verdana' size='1'>{{ Str::limit($msj->dsContenido,45)}}..</font></td>
                           <td align="center"><font face='verdana' size='1'><img border="0" style="cursor:pointer" idMensaje="{{$msj->id}}" class="btnVerMas" title="Ver mas" src="img/editar.jpg"/></font></td>                           
                       </tr> 
                 @endforeach 
            @endif                           
        </tbody>
    </table>
@stop
