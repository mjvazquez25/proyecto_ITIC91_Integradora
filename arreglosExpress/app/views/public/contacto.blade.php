
@extends('layouts.master2')

@section('content')

    {{ HTML::script('js/Validation.js'); }}
    {{ HTML::script('js/jquery.blockUI.js'); }}
    {{ HTML::script('js/contacto.js'); }}    
    
    <h1>Contactanos! </h1>
    
    <br/>
    
    <p>
        En arreglos express nos esmeramos por darles un mejor servicio día con día,
        es por eso que hemos creado esta sesión para que nos escriban sus dudas y 
        comentarios acerca de nuestros productos y servicios.
    </p>
    <br/>
     <form id="frmContacto">
        <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Nombre:</strong><br/>
                    <input type="text" name="txtNombre" id="txtNombre" size="65"/>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Apellidos:</strong><br/>
                     <input type="text" name="txtApellido" id="txtApellido" size="65"/>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Email:</strong><br/>
                     <input type="text" name="txtEmail" id="txtEmail" size="65"/>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Telefono:</strong><br/>
                     <input type="text" name="txtTelefono" id="txtTelefono" size="65"/>
                     <small style="color:red">Solo n&uacute;meros</small>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Comentario:</strong><br/>
                    <textarea name='txtComentario' id='txtComentario' id='' cols="98" rows="5"></textarea>
                </td>
            </tr>
            <tr>                    
                <td align="center">
                    <input type="button" id="enviarComentario" class="acepto" value="Enviar" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </form>
@stop