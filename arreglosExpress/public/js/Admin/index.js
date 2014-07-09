
$(document).ready(function(){
    
    $("#aceptar").click(function(){
        
         var usuario = $("#usuario").val();
            password = $("#pass").val();
            
         /*Primero validar que los campos no esten vacios...*/   
        if($.trim(usuario) == "")
	{
            alert("El campo Usuario es Requerido");
            $("#usuario").focus()
	}
	else
	{
            if($.trim(password)=="")
            {
                alert("El campo Password es Requerido");
                $("#pass").focus()
            }
            else
            {
                //enviar datos al controlador
                $("#frmLogin").submit();
            }
        }
    })
})

function Validar()
   {
   	
        
        if(usuario == "")
	{
		alert(lang.INDEX_LOGIN_FALTAUSUARIO);
		$("#usuario").focus()
	}
	else
	{
		if(password=="")
		{
			alert(lang.INDEX_LOGIN_FALTACONTRASENA);
			$("#pass").focus()
		}
		else
		{
            efectoBlock();
			$.ajax({
				type:"POST",
				url:'../ajax/loginAdmin.php',
				dataType:"json",
				data:'tamano1='+screen.width+'&tamano2='+screen.height+'&usr='+usuario+'&pwd='+password,
				success:function(respuesta)
				{
                    $.unblockUI(); 
					if(respuesta.error == 1)
					{
						alert(respuesta.detalle)
					}
					else
					{
                                                efectoBlock();
						location.href='admin.php';
					}
				}
			})
		}
	}
   } 

