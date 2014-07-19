@extends('layouts.masterAdmin')

@section('content')
    
    {{ HTML::style('css/uploadify.css'); }}
    
    {{ HTML::script('js/hayflash.js'); }}
    {{ HTML::script('js/Admin/nuevoProducto.js'); }}
    {{ HTML::script('js/jquery.blockUI.js'); }}
    {{ HTML::script('js/swfobject.js'); }}
    {{ HTML::script('js/jquery.uploadify.v2.1.4.js'); }}
    
    
    <!-- <div style="margin-top:5px;">    -->
        <h1 style="text-align:center">Nuevo Producto</h1>        
    <!-- </div> -->
    <br/>
     <form id="frmNuevoProducto">
        <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Nombre Producto:</strong><br/>
                    <input type="text" name="txtNombreProducto" id="txtNombreProducto" size="65"/>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Descripcion Producto:</strong><br/>
                    <textarea name='txtIdeaCreativa' id='txtIdeaCreativa' id='' cols="98" rows="5"></textarea>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Precio:</strong><br/>
                    $<input type="text" name="txtPrecio" id="txtPrecio" size="25"/>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Stock inicial:</strong><br/>
                    <input type="text" name="txtStock" id="txtStock" size="25"/>
                </td>
            </tr>
            <tr>
                <td align="center">
                     <strong>Adjuntar archivo:</strong><br/>
                     <div class="divupload">
                          <div id="custom-queue"></div>
                          <input  type="file" name="txtarchivo" id="txtarchivo" class="examinar"  size="20"/>                          
                      </div>

                      <div class="msjFlash">
                            <strong style="color:red;">Para poder adjuntar archivos a la solicitud debes instalar Flash Player en tu navegador.&nbsp;</strong>
                       </div>
                </td>
            </tr>
            <tr>                    
                <td align="center">
                    <input type="button" id="guardarProducto" class="acepto" value="Guardar" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </form>
@stop
