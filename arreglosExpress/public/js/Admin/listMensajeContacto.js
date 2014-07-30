

$(document).ready(function(){
    
    var dates = $( "#feInicio, #feFin" ).datepicker({
        maxDate: "0",
        showOn: "button",
        dateFormat: 'yy-mm-dd',
        buttonImageOnly: true,
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
          'Junio', 'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr',
         'May', 'Jun', 'Jul', 'Ago',
          'Sep', 'Oct', 'Nov', 'Dic'],
        buttonImage: "img/calendar.png",
        onSelect: function( selectedDate ) {
				var option = this.id == "feInicio" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
    })
    
    $(".btnVerMas").click(function(){
        var idMensaje = $(this).attr('idMensaje');
        
         efectoBlock();
        //ajax para eliminar el producto
        $.post("VerDetalleMensaje", 
            {
                idMensaje:idMensaje
            }, 
            function(data){               
                $.unblockUI();
                //console.log(data)
                               
                //validar respuesta                
                if(data.error == 1){
                    alert(data.detalle);                    
                }else{
                        //set valores a los labels
                        $("#lblRemitente").html(data.dsNombre)
                        $("#lblEmail").html(data.dsEmail)
                        $("#lblTelefono").html(data.dsTelefono)
                        $("#lblMensaje").html(data.dsContenido)

                        $("#windowDetalleMsj").dialog({
                            autoOpen: true,
                            width: 500,
                            modal:true,
                            closeOnEscape: true,
                            resizable:false,
                            title: "Detalle del Mensaje enviado por el cliente"
                        });
                }
            }) 
    }) 
    
})
