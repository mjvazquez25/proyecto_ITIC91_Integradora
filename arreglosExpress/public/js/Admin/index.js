
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
