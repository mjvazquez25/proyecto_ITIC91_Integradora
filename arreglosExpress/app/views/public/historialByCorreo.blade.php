
@extends('layouts.master2')

@section('content')

    {{ HTML::script('js/jquery.blockUI.js'); }}
    {{ HTML::script('js/Validation.js'); }}
    {{ HTML::script('js/historialCorreo.js'); }}

    <h1>Historial </h1>
    
    <br/>
     <form id="frmDetalleCompra">
        <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
            <tr class="solicitudMail">                    
                <td align="center">
                    <strong class="lblDescripcion">Por favor ingrese su correo electronico:</strong><br/>      
                    <input type="text" name="txtCorreoElectronico" id="txtCorreoElectronico" value="" size="45"/>
                </td>
            </tr>
            <tr id="trContinuar">                    
                <td align="center">
                    <input type="button" id="btnContinuar" value="ACEPTAR" style="cursor:pointer;position:relative;  height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </form>
@stop