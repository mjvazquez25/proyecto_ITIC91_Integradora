
$(document).ready(function(){
  
  //filtro calendario
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
    
    //eliminar producto
    $(".btnEliminar").click(function(){
        var idProducto = $(this).attr('idProducto');
        
         efectoBlock();
        //ajax para eliminar el producto
        $.post("EliminaProducto", 
            {
                idProducto:idProducto
            }, 
            function(data){               
                $.unblockUI();
                
                //validar respuesta                
                if(data.error == 1){
                    alert(data.detalle);                    
                }else{
                    alert('Datos modificados correctamente');
                    efectoBlock();
                    location.reload();
                }
            }) 
    })        
    
    //EditarProducto
    //editar producto
    $(".btnEditar").click(function(){
        var idProducto = $(this).attr('idProducto');
        location.href='EditarProducto?idProducto='+idProducto
    }) 
    
    //click al boton nuevo producto
    $("#nuevoProducto").click(function(){
        location.href='NuevoProducto'
    })
})
