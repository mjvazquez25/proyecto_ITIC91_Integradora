<!--
Proyecto: Arreglos Express

UTC
@autores;
Vazquez Sanchez Manuel
Cruz Davial Maria
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
{{ HTML::style('css/jflow.style.css'); }}

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="js/jflow.plus.min.js" type="text/javascript"></script>

<title>Arreglos Express</title>
</head>

<body>
<div id="container">
    <div id="mainpic">
            <div id="sliderContainer">
               <div id="mySlides">
                <div id="slide1" class="slide">  
                    <img src="images/img1.jpg" alt="Slide 1 jFlow Plus" />    
                    <div class="slideContent">
                        <h3>Arreglos</h3>
                        <p>consiguelo aqui!.</p>           
                    </div>    
                </div>    	    
                <div id="slide2" class="slide">    
                    <img src="images/img2.jpg" alt="Slide 2 jFlow Plus" />    
                    <div class="slideContent">
                        <h3>Servicios</h3>
                        <p>de alta calidad.</p>
                     </div>    
                </div>       
                <div id="slide3" class="slide">    
                    <img src="images/img3.jpg" alt="Slide 3 jFlow Plus" />    
                    <div class="slideContent"><h3>Arreglos Express</h3>
                    <p>Servicios a domicilio</p></div>    
                </div>        
                <div id="slide4" class="slide">    
                    <img src="images/img4.jpg" alt="Slide 3 jFlow Plus" />    
                    <div class="slideContent">
                        <h3>Eventos especiales</h3>
                        <p>Montamos la decoracion.</p>
                    </div>    
                </div>
            </div>

            <div id="myController">
               <span class="jFlowControl">1</span>
               <span class="jFlowControl">2</span>
               <span class="jFlowControl">3</span>
               <span class="jFlowControl">4</span>
            </div>

            <div class="jFlowPrev"></div>
            <div class="jFlowNext"></div>
        </div>
    <!--end: sliderContainer -->
    </div>   
        
    <!-- menu cliente -->
    <div id="menu">
        <ul>
            <li class="menuitem"><a href="#">Inicio</a></li>
            <li class="menuitem"><a href="#">Galeria</a></li>                
            <li class="menuitem"><a href="#">Faqs</a></li>                
            <li class="menuitem"><a href="#">Historial Pedidos</a></li>
            <li class="menuitem"><a href="#">Contacto</a></li>
            <li class="menuitem"><a href="#">Acerca de</a></li>
        </ul>
    </div>
    
    <!-- aqui ira el contenido principal de la pagina.. -->
    <div id="content">   
         @yield('content')
    </div>
</div>

<!-- footer de la pagina -->
<div class="footer_txt" style="background:url('images/Background-brown.png') center no-repeat;">
    <a href="#" class="Menu_pie_pagina">Faqs</a> 
    | <a href="#" class="Menu_pie_pagina">Contacto</a>&nbsp;|&nbsp;
    <a href="#" class="Menu_pie_pagina">Acerca de</a>&nbsp;&nbsp;<br />
    <span style="color:#000">
        Tel&eacute;fono: 01 800 343 8959  Lunes a Viernes de 9:00 a.m. a 7:00 p.m. S&aacute;bado: 9:00 am a 2:00 pm<br />
        Cancun, Q. Roo. C.P. 77710.<br />
        © Copyright 2014 Arreglos Express. Todos los derechos reservados. Powered by KEV-FER-JOSE-MANUEL.
    </span>    
</div>

</body>
</html>
