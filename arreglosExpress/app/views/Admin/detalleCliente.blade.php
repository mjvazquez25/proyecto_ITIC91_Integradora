@extends('layouts.masterAdmin')

@section('content')
        
    {{ HTML::script('js/Admin/detalleCliente.js'); }}
    
    <!-- <div style="margin-top:5px;">    -->
        <h1 style="text-align:center">Detalle Cliente</h1>        
    <!-- </div> -->
    <br/>
        <table id="tbNormal" border="0" style=" width: 100%; border-collapse: separate;border-spacing:12px; border:1px solid black">
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
            <tr>
                <td align="left">
                    <strong class="lblDescripcion">Direcciones: &nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <table style=" width: 100%">
                        <tr>
                            <td>
                                @if (count($Direccion) > 0)
                                    @foreach($Direccion as $direccion)
                                        <div id="tabs">
                                            <ul>
                                              <li><a href="#tabs-{{$direccion->id}}">{{$direccion->dsColonia}}</a></li>
                                            </ul>
                                            <div id="tabs-{{$direccion->id}}">
                                              <p>
                                                  <strong class="lblDescripcion">Calle: &nbsp;</strong>
                                                  <label>{{$direccion->dsCalle}}</label>
                                              </p>
                                              <p>
                                                  <strong class="lblDescripcion">Colonia: &nbsp;</strong>
                                                  <label>{{$direccion->dsColonia}}</label>
                                              </p>
                                              <p>
                                                  <strong class="lblDescripcion">Codigo Postal: &nbsp;</strong>
                                                  <label>{{$direccion->dsCodigoPostal}}</label>
                                              </p>
                                              <p>
                                                  <strong class="lblDescripcion">Ciudad: &nbsp;</strong>
                                                  <label>{{$direccion->dsCiudad}}</label>
                                              </p>
                                              <p>
                                                  <strong class="lblDescripcion">Telefono: &nbsp;</strong>
                                                  <label>{{$direccion->dsTelefono}}</label>
                                              </p>
                                              <p>
                                                  <strong class="lblDescripcion">Telefono Celular: &nbsp;</strong>
                                                  <label>{{$direccion->dsTelefonoMobile}}</label>
                                              </p>
                                            </div>
                                          </div>                                    
                                    @endforeach 
                                @endif   
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
@stop
