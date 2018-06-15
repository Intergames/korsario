$(document).ready(function () {
	$(".boton").click(function (){        
        $(".error").remove();		
        if( $(".LstCorresponsalia").val() == "" ){
            $(".LstCorresponsalia").focus().after("<span class='error'>Por favor elija la corresponsalia (*Requerido).</span>");			
            return false;
        }else if($(".LstMedidas").val() == ""){
			$(".LstMedidas").focus().after("<span class='error'>Por favor, elija la medida del anuncio *(Requerido).</span>");
			return false;
        }else if($(".TxtPrecioMinimo").val() == ""){
			$(".TxtPrecioMinimo").focus().after("<span class='error'>Por favor escriba el precio minimo (*Requerido).</span>");
			return false;
		}else if($(".TxtPrecioMaximo").val() == ""){
			$(".TxtPrecioMaximo").focus().after("<span class='error'>Por favor escriba el precio maximo (*Requerido).</span>");
			return false;
		}else if($(".TxtTipo").val() == ""){
			$(".TxtTipo").focus().after("<span class='error'>Por favor seleccione el tipo de anuncio (*Requerido).</span>");
			return false;
		}else if($(".LstVariante").val() == ""){
			$(".LstVariante").focus().after("<span class='error'>Por favor elija la variante del anucnio (*Requerido).</span>");
			return false;
        }	
    });    

    $(".LstCorresponsalia, .LstMedidas, .TxtPrecioMinimo, .TxtPrecioMaximo, .TxtTipo, .LstVariante").keyup(function(){
        if( $(this).val() != "" ){
            $(".error").fadeOut();			
            return false;
        }		
    });
});