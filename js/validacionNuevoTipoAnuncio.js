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
        }	
    });
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
        }	
    });

    $(".TxtSubTotalInformacionGeneral, .TxtIVAInformacionGeneral, .TxtTotalInformacionGeneral, .TxtSubTotalClasificado, .TxtIVAClasifcado, .TxtTotalClasificado").keyup(function(){
        if( $(this).val() != "" ){
            $(".error").fadeOut();			
            return false;
        }		
    });
});