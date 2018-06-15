$(document).ready(function () {
    $(".boton").click(function (){        
        $(".error").remove();		
        if( $(".TxtNombre").val() == "" ){
            $(".TxtNombre").focus().after("<span class='error'>Escriba un nombre para la corresponsalia *(Requerido).</span>");			
            return false;
        }else if( $(".TxtCalle").val() == "" ){
            $(".TxtCalle").focus().after("<span class='error'>Escriba un nombre para la calle *(Requerido).</span>");           
            return false;
        }else if( $(".TxtColonia").val() == "" ){
            $(".TxtColonia").focus().after("<span class='error'>Escriba un nombre de colonia valido *(Requerido).</span>");           
            return false;
        }else if($(".TxtCP").val() == ""){
            $(".TxtCP").focus().after("<span class='error'>Escriba un código Postal Valido *(Requerido).</span>");           
            return false;    
        }else if($(".TxtRFC").val() == ""){
            $(".TxtRFC").focus().after("<span class='error'>Por favor escriba el RFC asociado a la corresponsalia *(Requerido).</span>");           
            return false;
        }else if($(".TxtCiudad").val() == ""){
            $(".TxtCiudad").focus().after("<span class='error'>Escriba por favor la ciudad de la corresponsalía *(Requerido).</span>");           
            return false;
        }else if($(".TxtTelefono").val() == ""){
            $(".TxtTelefono").focus().after("<span class='error'>Escriba un número de teléfono valido *(Requerido).</span>");           
            return false;
        }	
    });

	$(".TxtNombre, .TxtCalle, .TxtColonia, .TxtCP .TxtRFC, .TxtCiudad, .TxtTelefono").keyup(function(){
            if( $(this).val() != "" ){
                $(".error").fadeOut();			
                return false;
            }		
	});
});