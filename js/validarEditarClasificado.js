$(document).ready(function () {        
    // Validamos el botón de guardar Clasificado.
    $(".guardarClasificado").click(function (){        
        $(".error").remove();		
        if( $(".TxtSubTotalClasificado").val() == "" ){
            $(".TxtSubTotalClasificado").focus().after("<span class='error'>Escriba el sub-total *(Requerido).</span>");			
            return false;
        }else if($(".TxtIVAClasifcado").val() == ""){
            $(".TxtIVAClasifcado").focus().after("<span class='error'>Por favor, escriba el IVA *(Requerido).</span>");
            return false;
        }else if($(".TxtTotalClasificado").val() == ""){
            $(".TxtTotalClasificado").focus().after("<span class='error'>Por favor escriba el Total*(Requerido).</span>");
            return false;
        }else if($(".FechasSeleccionadasClasificado").val() == ""){
            $(".FechasSeleccionadasClasificado").focus().after("<span class='error'>Por favor Seleccione al menos una fecha en el calendario *(Requerido).</span>");
            return false;
        }else if( $(".PalabrasClasificadoHidden").val() < 10 ){                                
            $(".TxtAnuncioClasificado").focus().after("<span class='error'>Por favor escriba un anuncio de por lo menos 10 palabras *(Requerido).</span>"); 
            return false;
        }else if((($(".TxtSubTotalClasificado").val() < $('#ValorMinimoTotalClasificado').val() || $(".TxtSubTotalClasificado").val() > $('#ValorMaximoTotalClasificado').val()) && ($('#ValorMaximoTotalClasificado').val() > 0 && $('#ValorMaximoTotalClasificado').val() > 0)) && $('#ListaTipoClasificado').val() == "Por Tamaño"){                    
            var respuesta;
            respuesta = $( "#dialogoClasificado" ).dialog( "open" ); 
            return false;                      
        }
        else
        {
            if(!$("#CortesiaClasificado").is(':checked') ) {	
            //alert("Se va a mandar el formulario");
            downloadButton = $( "#guardarInformacionGeneral" )
            .button()
            .on( "click", function() {
              $( this ).button( "option", {
                disabled: true,
                label: "Subiendo..."
              });
            });
            $( "#dialog").dialog( "open" );
            //return true;
            }						
        }
    });

    $(".TxtSubTotalClasificado, .TxtIVAClasifcado, .TxtTotalClasificado, .FechasSeleccionadas, .TxtAnuncioClasificado").keyup(function(){
        if( $(this).val() != "" ){
            $(".error").fadeOut();			
            return false;
        }		
    });
});