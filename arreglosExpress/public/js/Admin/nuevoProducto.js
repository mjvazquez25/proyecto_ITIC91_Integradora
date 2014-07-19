
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
                    'script'    : 'uploadArchivoHandle.php',
                    'cancelImg' : 'img/cancel.png',
                    'auto'      : true,
                    'folder'    : 'doc_brief',
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
  
    
})
