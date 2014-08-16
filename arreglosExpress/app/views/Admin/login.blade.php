<!--
Proyecto: Arreglos Express

UTC
@autores;
Vazquez Sanchez Manuel
Cruz Davila Maria
Ugarte Lopez Kevin
Alcudia Sosa Jose

Julio 2014
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login Admin :: Arreglos Express</title>
        
        <!-- se incluyen los archivos css -->
        {{ HTML::style('css/floreria.css'); }}        
        {{ HTML::style('css/indexAdmin.css'); }}
        
        <!-- se incluyen los archivos js -->
        {{ HTML::script('js/jquery/jquery-1.7.2.min.js'); }}
        {{ HTML::script('js/Admin/index.js'); }}
        
    </head>
    <body>
        
      <br/>  
      <h2 style="color:white; font-family: Arial,Helvetica,sans-serif; text-align: center">Arreglos Express :: Admin</h2>         
      <br/>
      
      {{-- Preguntamos si hay algun mensaje de error y si hay lo mostramos  --}}
        @if(Session::has('mensaje_error'))
            <script type="text/javascript"> alert(' {{ Session::get('mensaje_error') }} '); </script>
        @endif
      <div class="login_caja" id="login_caja" style="position:relative; margin:2% auto;">          
        <div style="position:relative; margin-left:30px; margin-right:30px;  height:200px;">
            <br />      
            <form name="login" id="frmLogin" action="Admin" method="post">            
            <table  CELLSPACING=3 CELLPADDING=3 align="left">        
                <tr>
                    <td  align="right" valign="middle">Usuario</td>
                    <td>&nbsp;</td>
                    <td><input  name="usuario" type="text" size="18"  id="usuario" Autocomplete="on" class="log_in" value=''/></td>
                </tr>
                <tr height="10px">
                    <td align="right" valign="middle">Contrase&ntilde;a</td>
                    <td>&nbsp;</td>
                    <td><input  name="password" type="password" size="18"  value='' maxlength="50"  id="pass"  class="log_in"/> </td>
                </tr>        
                <tr>
                    <td colspan="3" align="right">
                        <br>
                        <input type="button" id="aceptar" class="acepto" value="Aceptar" style="position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
                    </td>
                </tr>        
            </table>  
            </form>     
        </div>
      </div>
        
    </body>
</html>