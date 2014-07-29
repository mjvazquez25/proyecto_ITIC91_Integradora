
$(document).ready(function(){
    
    $(".rdbEntregado").click(function(){
        var idOrden = $("#idOrden").val();
        var cnEnviado = $(this).val();
        
         efectoBlock();
        //ajax para eliminar el producto
        $.post("UpdateEstatusEnvioOrden", 
            {
                idOrden:idOrden,
                cnEnviado: cnEnviado
            }, 
            function(data){               
                $.unblockUI();
                
                //validar respuesta                
                if(data.error == 1){
                    alert(data.detalle);                    
                }else{
                    alert('Datos modificados correctamente');
                }
            }) 
    })  
    
})


