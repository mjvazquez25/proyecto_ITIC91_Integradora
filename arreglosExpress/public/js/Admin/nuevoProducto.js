
var useFlash;

$(document).ready(function(){
  
  // si hay flash permitir upload fotos
    if($.hayFlash()) {
           useFlash = true;
    } // si no hay flash muestro  mensaje y no se permite upload files
    else {
           useFlash = false;
    }
    
  //ocultar msj requiere flash
     $(".msjFlash").hide();
     if (useFlash){ // si flash esta instalado configurar el modulo para upload de archivos
         //[Programacion para el modulo de upload archivos multiples]
         $('#txtarchivo').uploadify({
                    'uploader'  : 'js/uploadify.swf',
                    'script'    : 'uploadArchivoHandle',
                    'cancelImg' : 'img/cancel.png',
                    'auto'      : false,
                    'folder'    : 'uploadImg',
//                    'scriptData' : {'idProducto':10},
                    'queueID'    : 'custom-queue',
                    'buttonText' : "BUSCAR",
                    'width'      : 115,
                    'fileExt'    : '*.jpg;*.png;',
                    'fileDesc'   : 'Imagenes',
                    'displayData': 'speed',
                    'multi'      : false,                
                    'removeCompleted': false
                    //'sizeLimit'   :  2202009.5,//2 MB
                    //'simUploadLimit' : 10    
            });                                   
     }else{
         
         //ocultar plugin upload y mostrar mensaje
        $(".divupload").hide();
        $(".msjFlash").show();
     }
  
     $("#guardarProducto").click(function(){
         
        if($.trim($("#txtNombreProducto").val())==''){
            alert('Ingresa el Nombre del Producto');
            $("#txtNombreProducto").focus();
            return;
        }
        
        
        if($.trim($("#txtDescripcion").val())==''){
            alert('Ingresa la Descripcion del Producto');
            $("#txtDescripcion").focus();
            return;
        }
        
        if(!isValid($("#txtPrecio"),"Precio","numeric_decimal",false))
        {
            alert(_menError);
            _menError="";
            return;
        }
        
        if(!isValid($("#txtStock"),"Stock","numericpos",false))
        {
            alert(_menError);
            _menError="";
            return;
        }
        
        efectoBlock();
        $.post("GuardaProducto",//url destino
            $("#frmNuevoProducto").serialize(),//enviamos todos los datos del formulario
            function(data)
            {
                    $.unblockUI();        
                    //console.log(data)                    
                    if(data.error==1){//error                    
                        alert("Error al intentar Guardar el Producto.\n");
                    }else{//ok                    
                        if (useFlash){//upload archivos adjuntos
                                efectoBlock();
                                $('#txtarchivo').uploadifySettings('scriptData',{'idProducto':data.idProducto},true);
                                $('#txtarchivo').uploadifyUpload();
                                $.unblockUI();
                        }
                        alert("Producto guardado exitosamente!!");
                        location.href="AdminProducto";
                    }     
            })  
     })
    
})
