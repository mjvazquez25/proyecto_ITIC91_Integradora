
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
         var idProducto  = $("#idProducto").val()
         $('#txtarchivo').uploadify({
                    'uploader'  : 'js/uploadify.swf',
                    'script'    : 'uploadArchivoHandle',
                    'cancelImg' : 'img/cancel.png',
                    'auto'      : true,
                    'folder'    : 'uploadImg',
                    'scriptData' : {'idProducto':idProducto},
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
        $.post("UpdateProducto",//url destino
            $("#frmEditarProducto").serialize(),//enviamos todos los datos del formulario
            function(data)
            {
                    $.unblockUI();        
                    //console.log(data)                    
                    if(data.error==1){//error                    
                        alert("Error al intentar Actualizar el Producto.\n");
                    }else{//ok                    
                        if (useFlash){//upload archivos adjuntos
//                                efectoBlock();
//                                $('#txtarchivo').uploadifySettings('scriptData',{'idProducto':data.idProducto},true);
//                                $('#txtarchivo').uploadifyUpload();
//                                $.unblockUI();
                        }
                        alert("Producto Actualizado exitosamente!!");
                        location.href="AdminProducto";
                    }     
            })  
     })
     
     
     //eliminar producto
    $(".btnEliminarImagen").click(function(){
        var idProductoImagen = $(this).attr('idProductoImagen');
        
         efectoBlock();
        //ajax para eliminar el producto
        $.post("EliminaProductoImagen", 
            {
                idProductoImagen:idProductoImagen
            }, 
            function(data){               
                $.unblockUI();
                
                //validar respuesta                
                if(data.error == 1){
                    alert(data.detalle);                    
                }else{
                    alert('Imagen eliminada correctamente!');
                    $("#ImgProducto"+idProductoImagen).remove();
//                    efectoBlock();
//                    location.reload();
                }
            }) 
    })  
    
})
