
$(document).ready(function(){
    
    //inicializar galeria
    $("a[rel=group]").fancybox({
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'titlePosition' 	: 'over',
            'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                    return '<span id="fancybox-title-over">Arreglo ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
            }
    });

    //obtener altura del div que contiene la galeria de imgs
    var height = $("#leftPanel").height();
    height = height + 200
    //set height al div padre
    $("#content").height(height)
    
    //cargar carrito getCarrito
    $.post("GetCarrito",//url destino
        {},
            function(data)
            {     
                console.log(data)       
                if(data.error==1){//error                    
                    //alert("Error al intentar Cargar el Carrito.\n");
                    $(".block_contentCart").html('')
                }else{//ok 
                    //armar carrito 
                    //obtener array de producto
                    var list = data.listproducto;
                    var tam = list.length;

                    if(tam>0){//pintar carrito
                        armarCarrito(list)
                    }else{
                        //vaciar carrito
                        $(".block_contentCart").html('')
                    }
                }
            }) 
            
    
    $(".agregaProducto").change(function(){
        
        var idProducto = $(this).attr('idProducto')
        var flagAgrega = 0;
        
        if($(this).is(':checked')){
                flagAgrega = 1;
        }
        
        efectoBlock();
        $.post("UpdateCarrito",//url destino
            {
                idProducto : idProducto,
                flagAgrega : flagAgrega
            },
            function(data)
            {
                    $.unblockUI();        
                    console.log(data)       
                    if(data.error==1){//error                    
                        alert("Error al intentar Cargar el Carrito.\n");
                        $(".block_contentCart").html('')
                    }else{//ok 
                        //armar carrito 
                        //obtener array de producto
                        var list = data.listproducto;
                        var tam = list.length;
                        
                        if(tam>0){//pintar carrito
                            armarCarrito(list)
                        }else{
                            //vaciar carrito
                            $(".block_contentCart").html('')
                        }
                    }
            }) 
    })
     
})


function armarCarrito(list)
{    
    var listProductos = "";
    var noTotalPrecio = 0;

    //items -> productos del carrito
    for (var i=0; i<list.length; i++) {
        listProductos += " <dt class='first_item' id='cart_block_product_16' style='display: block;'>"
                                    + "<span class='quantity-formated'>"
                                    + "<span class='quantity' style='opacity: 1;'>1</span>x</span>"
                                        + "<a title='Gorra adulto...' style='color:black'>"+list[i].dsNombre+"</a>"
                                    + "<span class='price'>$"+list[i].noPrecio+" MXN </span>"
                            + "</dt>"
                            + "<div style='width: 100%;min-height:1px;background-color:#ff0099'></div>";

        noTotalPrecio += list[i].noPrecio;
        //set checks enabled
        $("#check-"+list[i].idProducto).attr('checked', true);

    }

    var HtmlCarrito = "<div id='content-cart' style='padding:6px 6px 2px'>" 
                    + " <div id='cart_block_list' class='expanded'> "				
                    + " <dl class='products'>"
                       + listProductos
                    + "</dl>"
                    + "<p id='cart-prices'>"							
                            + "<span>Total</span>"
                            + "<span id='cart_block_total' class='price ajax_block_cart_total'>$ "+noTotalPrecio+" MXN </span>"
                    + "</p>"
            + "</div>"
    + "</div>"
    + "<div id='cart-buttons' >"
               + "<a href='' id='button_order_cart' class='exclusive' title='Confirmar'>Confirmar</a>"
    + "</div>";

    $(".block_contentCart").html(HtmlCarrito)
    
}

