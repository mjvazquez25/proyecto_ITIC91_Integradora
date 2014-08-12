
@extends('layouts.master2')

@section('content')
           
    <center><h2>Ser&aacute;s redireccionado al sitio de PayPal.</h2></center>
    
    <form method="post" id="paypal_form" name="paypal_form" action="https://www.sandbox.paypal.com/cgi-binwebscr">
       
       <center><strong>Espere un momento por favor....</strong><br/><br/>
                  
        <input type="hidden" name="upload" value="1" />
        <input type="hidden" name="address_override" value="0" />
        <input type="hidden" name="first_name" value="{{$Cliente->dsNombre}}" />
        <input type="hidden" name="last_name" value="{{$Cliente->dsApellidoPaterno}}" />
        <input type="hidden" name="address1" value="{{$Direccion->dsCiudad}}" />
        
        <input type="hidden" name="amount" value="{{$noTotal}}" />
        <input type="hidden" name="email" value="{{$Cliente->dsEmail}}" />

        @if (count($listProducto) > 0)
            <small style="color: white">{{$i=1}}</small>
            @foreach($listProducto as $car)
            
                <input type="hidden" name="item_name_{{$i}}" value="{{$car['dsNombre']}}" />
                <input type="hidden" name="amount_{{$i}}" value="{{$car['noPrecio']}}" />
                <input type="hidden" name="quantity_{{$i}}" value="{{$car['noCantidad']}}" />
                
                <small style="color: white">{{$i++}}</small>
            @endforeach 
        @endif 
            
        
        <input type="hidden" name="business" value="manuel_ca7@hotmail.com" />
        <input type="hidden" name="receiver_email" value="manuel_ca7@hotmail.com" />
        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="charset" value="utf-8" />
        <input type="hidden" name="currency_code" value="MXN" />
        <!-- <input type="hidden" name="payer_id" value="{{$Cliente->id}}" />
        <input type="hidden" name="payer_email" value="{$customer->email}" /> -->
        <input type="hidden" name="custom" value="{{$idCarroCompra}}" />
        <input type="hidden" name="return" value="" />
        <input type="hidden" name="cancel_return" value="Galeria" />
        <input type="hidden" name="notify_url" value="validationPaypal" />

        <input type="hidden" name="rm" value="2" />
        <input type="hidden" name="bn" value="ARREGLOS EXPRESS" />
        <input type="hidden" name="cbt" value="Click aqui para regresar a la Tienda::Arreglos Express!" />
        
       <input type="image" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" 
        alt="PayPal The safer, easier way to pay online"></center>
    </form>
    
    <script type="text/javascript">
        $(document).ready(function() {
                $('#paypal_form').submit();
        });		
    </script>
@stop