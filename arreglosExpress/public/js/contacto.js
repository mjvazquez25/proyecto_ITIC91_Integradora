
$(document).ready(function(){  
  
    $("#enviarComentario").click(function(){
         
        if($.trim($("#txtNombre").val())==''){
            alert('Ingresa tu Nombre');
            $("#txtNombre").focus();
            return;
        }
        
        
        if($.trim($("#txtApellido").val())==''){
            alert('Ingresa tus Apellidos');
            $("#txtApellido").focus();
            return;
        }
        
        if(!isValid($("#txtEmail"),"Email","mail",false))
        {
            alert(_menError);
            _menError="";
            return;
        }
        
        if(!isValid($("#txtTelefono"),"Telefono","numericpos",false))
        {
            alert(_menError);
            _menError="";
            return;
        }
        
        if($.trim($("#txtComentario").val())==''){
            alert('Ingresa tus Comentarios / Sugerencias');
            $("#txtComentario").focus();
            return;
        }
      
        efectoBlock();
        $.post("GuardaMensaje",//url destino
            $("#frmContacto").serialize(),//enviamos todos los datos del formulario
            function(data)
            {
                    $.unblockUI();        
                    //console.log(data)                    
                    if(data.error==1){//error                    
                        alert("Error al intentar Enviar el Comentario.\n");
                    }else{//ok   
                        alert("Comentario enviado exitosamente!!");
                        location.reload();
                    }     
            })  
     })
})
