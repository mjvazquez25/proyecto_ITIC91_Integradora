
@extends('layouts.master2')

@section('content')

    {{ HTML::script('js/jquery.blockUI.js'); }}
    {{ HTML::script('js/Validation.js'); }}
    {{ HTML::script('js/datoscliente.js'); }}

    <h1>Datos del Cliente </h1>
    
    <br/>
     <form id="frmDetalleCompra">
        <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
            <tr class="solicitudMail">                    
                <td align="center">
                    <strong class="lblDescripcion">Por favor ingrese su correo electronico:</strong><br/>      
                    <input type="text" name="txtCorreoElectronico" id="txtCorreoElectronico" value="" size="45"/>
                </td>
            </tr>
            <tr class="solicitudMail">                    
                <td align="center">
                    <input type="button" id="btnAceptarMail" value="Aceptar"  style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td><br/></td>
            </tr>
            <tr class="datosCliente">                    
                <td align="center">
                    <h2 id="lblTituloCliente">Por favor ingresa los siguientes datos</h2>
                </td>
            </tr>
            <tr class="datosCliente">                    
                <td align="center">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Nombre:</strong><br/>
                    <input type="text" name="txtNombre" id="txtNombre" size="65"/>
                </td>
            </tr>
            <tr class="datosCliente">                    
                <td align="center">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Apellido Paterno:</strong><br/>
                    <input type="text" name="txtApellidoPaterno" id="txtApellidoPaterno" size="65"/>
                </td>
            </tr>
            <tr class="datosCliente">                    
                <td align="center">
                    <strong class="lblDescripcion">Apellido Materno:</strong><br/>
                    <input type="text" name="txtApellidoMaterno" id="txtApellidoMaterno" size="65"/>
                </td>
            </tr>
            <tr class="datosCliente">                    
                <td align="center">
                    <font color="red" size="3">*</font>
                    <strong class="lblDescripcion">Email:</strong><br/>
                    <input type="text" name="txtEmail" id="txtEmail" size="65"/>
                </td>
            </tr>
            <tr class="datosCliente">                    
                <td align="center">
                    <input type="hidden" value="" name="cmd" id="cmd"/>
                    <input type="hidden" value="" name="idCliente" id="idCliente"/>
                    <input type="button" id="btnAceptarDatosCliente" value="Aceptar"  style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
            <tr class="datosDireccion">
                <td>
                    <table style=" width: 100%" border='0'>
                        <tr>
                            <td><strong>Nombre: </strong><label id="lblNombreCliente">xxx</label></td>
                        </tr>
                        <tr>
                            <td><strong>Apellidos: </strong><label id="lblApellidosCliente">xxx</label></td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong> <label id="lblEmailCliente">xxx</label></td>
                        </tr>
                        <tr>
                            <td><br/><br/></td>
                        </tr>
                        <tr>
                            <td>
                                Elije una direccion de entrega: 
                                <select id="cmbDirecciones" name="cmbDirecciones">
                                </select>
                                 <br/>
                                 <input type="button" value="Agregar Direccion" id="btnNuevaDireccion" />
                                 <br/><br/>
                            </td>
                        </tr>
                        <tr class="trNuevaDireccion">
                            <td>
                                <table style=" width: 100%" id="">
                                     <tr>                    
                                        <td align="center">
                                            <strong class="lblDescripcion">Ciudad:</strong><br/>      
                                            <input type="text" name="txtCiudad" id="txtCiudad" value="" size="45"/>
                                        </td>
                                    </tr>
                                    <tr>                    
                                        <td align="center">
                                            <strong class="lblDescripcion">Colonia:</strong><br/>      
                                            <input type="text" name="txtColonia" id="txtColonia" value="" size="45"/>
                                        </td>
                                    </tr>
                                    <tr>                    
                                        <td align="center">
                                            <strong class="lblDescripcion">Calle:</strong><br/>      
                                            <input type="text" name="txtCalle" id="txtCalle" value="" size="45"/>
                                        </td>
                                    </tr>
                                    <tr>                    
                                        <td align="center">
                                            <strong class="lblDescripcion">Codigo Postal:</strong><br/>      
                                            <input type="text" name="txtCodigoPostal" id="txtCodigoPostal" value="" size="45"/><br/>
                                            <small style="color:red">Solo n&uacute;meros</small>
                                        </td>
                                    </tr>
                                    <tr>                    
                                        <td align="center">
                                            <strong class="lblDescripcion">Telefono:</strong><br/>      
                                            <input type="text" name="txtTelefono" id="txtTelefono" value="" size="45"/><br/>
                                            <small style="color:red">Solo n&uacute;meros</small>
                                        </td>
                                    </tr>
                                    <tr>                    
                                        <td align="center">
                                            <strong class="lblDescripcion">Telefono celular:</strong><br/>      
                                            <input type="text" name="txtTelefonoCelular" id="txtTelefonoCelular" value="" size="45"/><br/>
                                            <small style="color:red">Solo n&uacute;meros</small>
                                        </td>
                                    </tr>
                                    <tr>                    
                                        <td align="center">
                                            <br/>                                            
                                            <input type="hidden" value="" id="cmdDireccion" name="cmdDireccion"/>
                                            <input type="button" value="Guardar Direccion" id="btnGuardarDireccion" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr id="trContinuar" style="display: none">                    
                <td align="center">
                    <input type="button" id="btnContinuar" value="Continuar con la compra" style="cursor:pointer;position:relative;  height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </form>
@stop