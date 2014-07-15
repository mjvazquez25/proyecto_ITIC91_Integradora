<!--
Proyecto: Arreglos Express :: Admin

UTC
@autores;
Vazquez Sanchez Manuel
Cruz Davila Maria
Ugarte Lopez Kevin
Alcudia Sosa Jose

Julio 2014
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- se incluyen los archivos css -->
{{ HTML::style('css/floreria.css'); }}
{{ HTML::style('css/menuAdmin.css'); }}
{{ HTML::style('css/listAdmin.css'); }}

<!-- se incluyen los archivos js -->
{{ HTML::script('js/jquery/jquery-1.7.2.min.js'); }}

<title>Arreglos Express :: Admin </title>
</head>
    
<body>
    
<div id="menuAdmin">
    <ul>
      <li class="nivel1"><a href="AdminProducto" class="nivel1">Productos</a>	
        </li>
        <li class="nivel1"><a href="#" class="nivel1">Clientes</a>
      </li>
        <li class="nivel1"><a href="#" class="nivel1">Ventas</a>
      </li>
        <li class="nivel1"><a href="#" class="nivel1">Mensajes</a>
      </li>
        <li class="nivel1"><a href="Admin" class="nivel1">Salir</a>
      </li>
    </ul>
</div>

<div id="container" style="top:50px">    
    <!-- aqui ira el contenido principal de la pagina.. -->
    <div id="content" style="min-height: 500px;margin-bottom:6px">   
         @yield('content')
    </div>
</div> 
    
    
<br/><br/><br/>
<!-- footer de la pagina --> 
<div class="footer_txt" style="background:url('img/Background-brown.png') center no-repeat; height: 20px; margin-bottom: 13px;">
    <span>
        © Copyright 2014 Arreglos Express. Todos los derechos reservados. Powered by KEV-FER-JOSE-MANUEL.
    </span>    
</div>

</body>
</html>
    

