$(document).ready(function () {
    $(".guardarEditarCliente").click(function (){        
        $(".error").remove();		
        if( $("#TxtCodigo").val() == "" ){
            $("#TxtPasswrd").focus().after("<span class='error'>Escriba una contraseña *(Requerido).</span>");			
            return false;
        }else if($("#TxtNombreUsuario").val() == ""){
            $("#TxtNombreUsuario").focus().after("<span class='error'>Por favor, escriba el nombre de usuario *(Requerido).</span>");
            return false;
            }
    });       

    $("#TxtPasswrd, #TxtNombreUsuario").keyup(function(){
        if( $(this).val() != "" ){
            $(".error").fadeOut();			
            return false;
        }		
    });
});