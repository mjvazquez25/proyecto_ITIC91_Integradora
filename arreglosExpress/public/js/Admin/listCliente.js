
$(document).ready(function(){
  
    /*detalle de cliente*/
    $(".btnVerDetalle").click(function(){
        var idCliente = $(this).attr('idCliente');
        location.href='AdminClienteDetalle?idCliente='+idCliente
    }) 
    
})

