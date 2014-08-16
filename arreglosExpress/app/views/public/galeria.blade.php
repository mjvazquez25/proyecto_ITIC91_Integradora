
@extends('layouts.master2')

@section('content')

    {{ HTML::style('css/galeria.css'); }}
    {{ HTML::style('css/jquery.fancybox-1.3.4.css'); }} 
    
    {{ HTML::script('js/jquery.mousewheel-3.0.4.pack.js'); }}
    {{ HTML::script('js/jquery.fancybox-1.3.4.pack.js'); }}
    {{ HTML::script('js/jquery.blockUI.js'); }}
    {{ HTML::script('js/galeria.js'); }}    
    
    <h1>Galeria de Productos </h1>
    <br/>
    
    <div id="leftPanel">
        <div style="width: 99%; height: 100%;">   
            
             @if (count($listProducto) > 0)             
                <table border="0"><tr>                        
                @for ($i = 0; $i < count($listProducto); $i++)
                
                    @if ($toptd < 4)
                            <td>                                
                                <div style="width:108px; height:108px; padding: 3px; background:#FFFFFF; margin: 2px">
                                    <a href='uploadImg/{{$listProducto[$i]->dsRuta}}' rel='group' title='{{$listProducto[$i]->dsDescripcion}}'>
                                        <img alt="" width='108' height='108' src='uploadImg/{{$listProducto[$i]->dsRuta}}' title="{{$listProducto[$i]->dsNombre}}" border="0">
                                    </a>
                                </div>
                                <input type='checkbox' name='' value='' id="check-{{$listProducto[$i]->id}}" class="agregaProducto" idProducto='{{$listProducto[$i]->id}}'> {{ Str::limit($listProducto[$i]->dsNombre,15)}}. <br/>
                                <b style="color:red">$ {{$listProducto[$i]->noPrecio}} MXN</b><br/>
                                <small style="color:white">{{ $toptd++; }}</small>
                            </td>                             
                    @else
                            </tr>
                            <tr>
                                <td>
                                    <div style="width:108px; height:108px; padding: 3px; background:#FFFFFF; margin: 2px">
                                    <a href='uploadImg/{{$listProducto[$i]->dsRuta}}' rel='group' title='{{$listProducto[$i]->dsDescripcion}}'>
                                        <img alt="" width='108' height='108' src='uploadImg/{{$listProducto[$i]->dsRuta}}' title="{{$listProducto[$i]->dsNombre}}" border="0">
                                    </a>
                                </div>
                                <input type='checkbox' name='' id="check-{{$listProducto[$i]->id}}" value='' class="agregaProducto" idProducto='{{$listProducto[$i]->id}}'> {{ Str::limit($listProducto[$i]->dsNombre,15)}}. <br/>
                                <b style="color:red">$ {{$listProducto[$i]->noPrecio}} MXN</b><br/>
                                <small style="color:white">{{ $toptd=1; }}</small>
                                </td>                            
                    @endif                                      
                @endfor
                     </tr></table> 
            @endif
        </div>
    </div>
        
    <div id="rightPanel">
        <h1 style="text-align:center; font-size:13px">CARRITO</h1>
        <hr></hr>
        <div id="displayCarrito">
        <div id="cart_block" class="block exclusive">        
            <div class="block_contentCart">
                
            </div>
        </div>
        </div>
    </div>
    
@stop