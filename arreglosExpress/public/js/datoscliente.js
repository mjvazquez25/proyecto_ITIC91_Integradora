
$(document).ready(function(){  
    
    $(".datosCliente").hide();
    
    $( "#tabs" ).tabs();
    
    $("#btnAceptarDatosCliente").click(function(){
        
        if($.trim($("#txtNombre").val())==''){
            alert('Ingresa tu Nombre');
            $("#txtNombre").focus();
            return;
        }
        
        if($.trim($("#txtApellidoPaterno").val())==''){
            alert('Ingresa tu Apellido Paterno');
            $("#txtApellidoPaterno").focus();
            return;
        }
                
        if(!isValid($("#txtEmail"),"Email","mail",false))
        {
            alert(_menError);
            _menError="";
            return;
        }
        
         efectoBlock();
        $.post(
            'updateDatosCliente',
            {
                txtNombre: $("#txtNombre").val(),
                txtApellidoPaterno: $("#txtApellidoPaterno").val(),
                txtApellidoMaterno: $("#txtApellidoMaterno").val(),
                txtEmail: $("#txtEmail").val(),
                cmd: $("#cmd").val(),
                idCliente: $("#idCliente").val()
            },
            function(data){
                $.unblockUI();        
                //console.log(data)                    
                if(data.error==1){//error                    
                    alert(data.detalle+'');
                }else{//ok  
                    
                     $("#lblNombreCliente").html($("#txtNombre").val());
                     $("#lblApellidosCliente").html($("#txtApellidoPaterno").val() + ' ' + $("#txtApellidoMaterno").val())
                     $("#lblEmailCliente").html($("#txtEmail").val())
                     
                     //cargar listado de direcciones
                     for (var i=0; i<data.listDireccion; i++) {
                         console.log('aqui ' + i)
                         var option = "<option value='"+data.listDireccion[i].idDireccion+"'>"+data.listDireccion[i].dsCiudad +" "+ data.listDireccion[i].dsColonia +"</option>";
                         $("#cmbDirecciones").append(option);
                     }
                }     
            }
            
        )
    })    
    
    $("#btnAceptarMail").click(function(){
        
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
                                //cargar datos
                                $("#lblTituloCliente").html("Por favor verifique si sus datos son correctos")
                                $("#txtNombre").val(data.dataCliente[0].dsNombre)
                                $("#txtApellidoPaterno").val(data.dataCliente[0].dsApellidoPaterno)
                                $("#txtApellidoMaterno").val(data.dataCliente[0].dsApellidoMaterno)
                                $("#idCliente").val(data.dataCliente[0].idCliente)
                                $("#cmd").val('upd')
                            }else{
                                //cambiar texto h2
                                $("#lblTituloCliente").html("Por favor ingresa los siguientes datos")
                                $("#cmd").val('add')
                            }
                            //ocultar tr :: solicitud correo
                            $(".solicitudMail").hide();
                            $(".datosCliente").show();
                            $("#txtEmail").val($("#txtCorreoElectronico").val())                            
                        }
                    }
                )
                
        } 
    })  
})

