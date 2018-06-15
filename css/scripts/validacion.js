$(document).ready(function () {
	var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	var Telefonoreg = /^[0-9_\.\-()]+$/;
	$(".boton").click(function (){
		$(".error").remove();		
		if( $(".Sucursal").val() == "Null" ){
			$(".Sucursal").focus().after("<span class='error'>Elija la sucursal a la que pertenecer&aacute; el usuario.</span>");
			return false;
		}else if( $(".Nombre").val() == "" ){
			$(".Nombre").focus().after("<span class='error'>Escriba el nombre del usuario completo.</span>");
			return false;
		}else if( !Telefonoreg.test($(".Telefono").val()) ){
			$(".Telefono").focus().after("<span class='error'>Escriba un tel&eacute;fono valido.</span>");
			return false;	
		}else if( $(".email").val() == "" || !emailreg.test($(".email").val()) ){
			$(".email").focus().after("<span class='error'>Escriba un email correcto.</span>");
			return false;
		}else if( $(".Usuario").val() == "" ){
			$(".Usuario").focus().after("<span class='error'>Escriba un nombre de usuario.</span>");
			return false;
		}else if( $(".Password").val() == "" ){
			$(".Password").focus().after("<span class='error'>Escriba un password.</span>");
			return false;	
		}else if( $(".RepetirPassword").val() == "" ){
			$(".RepetirPassword").focus().after("<span class='error'>Escriba nuevamente su password.</span>");
			return false;
		}else if( $(".RepetirPassword").val() != $(".Password").val() ){
			$(".Password").focus().after("<span class='error'>Los Password no coinciden.</span>");
			return false;	
		}else if( $(".ValidaUsuario").val() =="False" ){
			$(".Usuario").focus().after("<span class='error'>Elija un nombre de usuario diferente.</span>");
			return false;		
		}
	});
	$(".Nombre, .email, .Usuario, .Password, .RepetirPassword, .Telefono").keyup(function(){
		if( $(this).val() != "" ){
			$(".error").fadeOut();			
			return false;
		}		
	});
	$(".email").keyup(function(){
		if( $(this).val() != "" && emailreg.test($(this).val())){
			$(".error").fadeOut();			
			return false;
		}		
	});
	$(".Telefono").keyup(function(){
		if( $(this).val() != "" && Telefonoreg.test($(this).val())){
			$(".error").fadeOut();			
			return false;
		}		
	});
});