$(document).ready(function () {
    $(".guardarInformacionGeneral").click(function (){        
        $(".error").remove();		
        if( $(".TxtSubTotalInformacionGeneral").val() == "" ){
            $(".TxtSubTotalInformacionGeneral").focus().after("<span class='error'>Escriba el sub-total *(Requerido).</span>");			
            return false;
        }else if($(".TxtIVAInformacionGeneral").val() == ""){
            $(".TxtIVAInformacionGeneral").focus().after("<span class='error'>Por favor, escriba el IVA *(Requerido).</span>");
            return false;
        }else if($(".TxtTotalInformacionGeneral").val() == ""){
            $(".TxtTotalInformacionGeneral").focus().after("<span class='error'>Por favor escriba el Total*(Requerido).</span>");
            return false;
        }else if($(".CajaFechasSeleccionadas").val() == ""){
            $(".FechasSeleccionadas").focus().after("<span class='error'>Por favor Seleccione al menos una fecha en el calendario *(Requerido).</span>");
            return false;
        }else if(($("#TxtPrecioDiarioInformacionGeneral").val() < $('#ValorMinimoTotalInformacionGeneral').val() || $(".TxtPrecioDiarioInformacionGeneral").val() > $('#ValorMaximoTotalInformacionGeneral').val()) ){                    
            if( $("#CortesiaInformacionGeneral").is(':checked'))
                return true		 
            else
            {
                var respuesta;
                respuesta = $( "#dialogo" ).dialog( "open" ); 
                return false;
            }
        }
        else
        {
            if(!$("#CortesiaInformacionGeneral").is(':checked') ) {	
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

    $(".TxtSubTotalInformacionGeneral, .TxtIVAInformacionGeneral, .TxtTotalInformacionGeneral .FechasSeleccionadas").keyup(function(){
        if( $(this).val() != "" ){
            $(".error").fadeOut();			
            return false;
        }		
    });
});