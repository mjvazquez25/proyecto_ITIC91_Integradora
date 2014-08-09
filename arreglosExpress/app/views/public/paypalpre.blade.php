
@extends('layouts.master2')

@section('content')
           
    <center><h2>Ser&aacute;s redireccionado al sitio de PayPal.</h2></center>
    
    <form method="post" name="paypal_form" action="">
        <input type="hidden" name="" value=""/>
        <center><br/><br/>Click en el siguiente boton<br/><br/>
       <input type="image" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" 
        alt="PayPal The safer, easier way to pay online"></center>
    </form>
@stop