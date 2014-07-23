@extends('layouts.masterAdmin')

@section('content')
    
    {{ HTML::style('css/uploadify.css'); }}
    
    {{ HTML::script('js/Validation.js'); }}
    {{ HTML::script('js/hayflash.js'); }}
    {{ HTML::script('js/Admin/editarProducto.js'); }}
    {{ HTML::script('js/jquery.blockUI.js'); }}
    {{ HTML::script('js/swfobject.js'); }}
    {{ HTML::script('js/jquery.uploadify.v2.1.4.js'); }}
        
    <!-- <div style="margin-top:5px;">    -->
        <h1 style="text-align:center">Editar Producto</h1>        
    <!-- </div> -->
    <br/>
     <form id="frmEditarProducto">
        <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Nombre Producto:</strong><br/>
                    <input type="text" name="txtNombreProducto" id="txtNombreProducto" size="65" value="{{$dsNombre}}"/>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Descripcion Producto:</strong><br/>
                    <textarea name='txtDescripcion' id='txtDescripcion' id='' cols="98" rows="5">{{$dsDescripcion}}</textarea>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Precio:</strong><br/>
                    $<input type="text" name="txtPrecio" id="txtPrecio" size="25" value="{{$noPrecio}}"/>
                    <small style="color:red">Solo n&uacute;meros</small>
                </td>
            </tr>
            <tr>                    
                <td align="left">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Stock:</strong><br/>
                    <input type="text" name="txtStock" id="txtStock" size="25" value="{{$noStock}}"/>
                    <small style="color:red">Solo n&uacute;meros</small>
                </td>
            </tr>
            <tr>
                <td align="left">
                     <strong>Imagenes del producto:</strong><br/>
                     <div style=' width: 830px; padding:2px; min-height:30px; max-height: 118px; overflow:auto; height: 107px'>
                        <div style=' width: auto; height: 100%;'> 
                            @if (count($listProductoImagen) > 0)
                                @for ($i = 0; $i < count($listProductoImagen); $i++)
                                    <div id="ImgProducto{{$listProductoImagen[$i]->id}}" style='width:140px; height:83px; float:left; display:block; border: 1px solid black; position:relative'>                                        
                                        <img style='width:140px; height:82px;' src="uploadImg/{{$listProductoImagen[$i]->dsRuta}}"/>                                        
                                        <br/>
                                        <div style="width: 140px">
                                            <div style="font-size: 12px; font-weight: bold; width:100%; word-wrap: break-word;">
                                                <a title="click para eliminar imagen" class="btnEliminarImagen" style="cursor:pointer" idProductoImagen="{{$listProductoImagen[$i]->id}}">[Eliminar]</a>
                                            </div>
                                        </div>
                                    </div>                                    
                                @endfor
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center">
                     <strong>Subir Imagen:</strong><br/>
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
                    <input  type="hidden" id="idProducto" name="idProducto" value="{{$idProducto}}"/>
                    <input type="button" id="guardarProducto" class="acepto" value="Guardar" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </form>
@stop
