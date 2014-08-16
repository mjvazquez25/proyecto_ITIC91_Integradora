
$(document).ready(function(){  
    
    $(".datosCliente").hide();
    $(".trNuevaDireccion").hide();
    $(".datosDireccion").hide();
    
    $( "#tabs" ).tabs();
    
    /*
     * mostrar formulario para alta nueva direccion
     */
    $("#btnNuevaDireccion").click(function()
    {
        $(".trNuevaDireccion").show();
        $("#btnNuevaDireccion").hide();
        $("#cmdDireccion").val('add')
    })
    
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
                     $(".datosDireccion").show();
                     $(".datosCliente").hide();
                     
                     $("#lblTituloCliente").html('Direccion de entrega')
                     
                      var list = data.listDireccion;
                      var tam = list.length;
                                          
                     
                     if(tam<=0){//si no existen direcciones
                          var optionNone = "<option value='-1'>Aun no ha registrado ninguna direccion</option>";
                         $("#cmbDirecciones").append(optionNone);
                     }else{
                         var optionFirst = "<option value='-1'>Direccion de entrega</option>";
                         $("#cmbDirecciones").append(optionFirst);
                     }
                     
                     //cargar listado de direcciones
                     for (var i=0; i<list.length; i++) {
                         var option = "<option value='"+data.listDireccion[i].idDireccion+"'>"+data.listDireccion[i].dsCiudad +" "+ data.listDireccion[i].dsColonia +"</option>";
                         $("#cmbDirecciones").append(option);
                     }
                }     
            }
            
        )
    })   
    
    $("#cmbDirecciones").change(function()
    {
        var id = $(this).val()
        if(id != -1){
            
            //obtener datos de la direccion y cargarla en los inputs                      
            $.post(
            'getDataDireccion',
            {
                idDireccion: id
            },
            function(data)
            {
                if(data.error==1){//error                    
                    alert(data.detalle);
                }else{//ok 
                    var dataDireccion = data.dataDireccion;
                    //cargar direccion en el combo y mostrar boton de continuar
                    $("#txtCiudad").val(dataDireccion.dsCiudad);
                    $("#txtColonia").val(dataDireccion.dsColonia);
                    $("#txtCalle").val(dataDireccion.dsCalle);
                    $("#txtCodigoPostal").val(dataDireccion.dsCodigoPostal);
                    $("#txtTelefono").val(dataDireccion.dsTelefono);
                    $("#txtTelefonoCelular").val(dataDireccion.dsTelefonoMobile);
                }
            })
            
            $(".trNuevaDireccion").show();
            $("#cmdDireccion").val('upd')
            $("#btnNuevaDireccion").hide();
            
        }else{
           //ocultar  y limpiar campos
            $("#txtCiudad").val('');
            $("#txtColonia").val('');
            $("#txtCalle").val('');
            $("#txtCodigoPostal").val('');
            $("#txtTelefono").val('');
            $("#txtTelefonoCelular").val('');
            
             $("#cmdDireccion").val('add')
            $(".trNuevaDireccion").hide();
            $("#btnNuevaDireccion").show();
       }
    })
    
    $("#btnGuardarDireccion").click(function()
    {
        if($.trim($("#txtCiudad").val())==''){
            alert('Ingresa el nombre de la ciudad');
            $("#txtCiudad").focus();
            return;
        }
        
        if($.trim($("#txtColonia").val())==''){
            alert('Ingresa el nombre de la colonia');
            $("#txtColonia").focus();
            return;
        }
        
        if($.trim($("#txtCalle").val())==''){
            alert('Ingresa la calle');
            $("#txtCalle").focus();
            return;
        }
        
        if(!isValid($("#txtCodigoPostal"),"Codigo postal","numericpos",false))
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
        
        if(!isValid($("#txtTelefonoCelular"),"Telefono Celular","numericpos",false))
        {
            alert(_menError);
            _menError="";
            return;
        }
        
        $.post(
            'guardaDireccion',
            {
                txtCiudad: $("#txtCiudad").val(),
                txtColonia: $("#txtColonia").val(),
                txtCalle: $("#txtCalle").val(),
                txtCodigoPostal: $("#txtCodigoPostal").val(),
                txtTelefono: $("#txtTelefono").val(),
                txtTelefonoCelular: $("#txtTelefonoCelular").val(),
                cmd: $("#cmdDireccion").val(),
                idDireccion: $("#cmbDirecciones option:selected").val()
            },
            function(data){
                //console.log(data)
                if(data.error==1){//error                    
                    alert(data.detalle);
                }else{//ok 
                    
                    if($("#cmdDireccion").val() == 'add'){
                        //cargar direccion en el combo y mostrar boton de continuar
                        var option = "<option selected value='"+data.idDireccion+"'>"+$("#txtCiudad").val()+" "+ $("#txtColonia").val() +"</option>";
                        $("#cmbDirecciones").append(option)
                    }
                    
                    $("#trContinuar").show();
                    $(".trNuevaDireccion").hide()
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
    
    
    /*
     * continuar con la compra: direccionar a la pagina de resumen
     */
    $("#btnContinuar").click(function()
    {
        //validar que haya seleccionado una direccion
        var idDireccion = $("#cmbDirecciones option:selected").val()
        if(idDireccion == -1)
            {
                alert('Debes seleccionar una direccion de entrega valida!')
                return;
            }
        
        efectoBlock();
        //actualizamos los datos del carrito de compra
        $.ajax
        ({
            type: "POST",
            url: 'guardaDireccionCarrito',
            data: "idDireccion="+idDireccion,
            async:false,
            success: function(data)
            {
                $.unblockUI();
                if(data.error==1){//error                    
                    alert(data.detalle);
                }else{//ok 
                    location.href='ResumenPedido'
                }
            }
        })


    })
})

