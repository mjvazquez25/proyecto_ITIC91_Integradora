
$(document).ready(function(){
    
/*
 * Verificar si la cuenta de correo ya existe en la BD
 */
  $("#btnContinuar").click(function(){
        
        if(!isValid($("#txtCorreoElectronico"),"Correo Electronico","mail",false))
        {
            alert(_menError);
            _menError="";
            return;
        }
        
        var r = confirm("Su direccion de correo es: " + $("#txtCorreoElectronico").val());
        if (r == true) {
                //enviar datos por ajax para verificar si el correo electronico ya existe en la bd                                
                $.post(
                    'verificaCorreoCliente',
                    {
                        dsCorreoElectronico : $("#txtCorreoElectronico").val()
                    },
                    function(data){
                        if(data.error==1){//error                    
                            alert(data.detalle);
                        }else{//ok 
                            //verificar si el cliente ya existe
                            if(data.cnExiste == 1)
                            {
                                //redireccionar a la vista de historial
                                location.href="HistorialById?idCliente="+data.dataCliente[0].idCliente;
                                
                            }else{
                                //msj de aviso al usuario
                                alert('Lo sentimos, esta direccion de correo: '+ $("#txtCorreoElectronico").val() + ' No esta asociada a niguna compra!.')
                            }                           
                        }
                    }
                )
                
        } 
    })    
})