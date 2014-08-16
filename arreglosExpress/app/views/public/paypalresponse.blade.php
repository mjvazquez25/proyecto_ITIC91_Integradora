
@extends('layouts.master2')

@section('content')

    
    <h1>Compra exitosa!! </h1>
    <br/>
    <h2>
        Gracias por comprar con nosotros.<br/><br/>
        En breve enviaremos tu paquete al domicilio que registraste en nuestra pagina.<br/>
        Puedes ver el detalle de tu pedido dando click en el siguiente boton:
        <br/>
        <input type="button" value="Ver Detalle" onclick="location.href='Historial'" style="cursor:pointer;position:relative; width:145px; height:30px; background:#BEC780; border-radius:7px; -moz-border-radius:7px; -webkit-border-radius:7px; text-transform: uppercase;"/>&nbsp;&nbsp;
    </h2>
    <br/>
@stop