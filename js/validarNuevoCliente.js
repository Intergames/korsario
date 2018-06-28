$(document).ready(function () {
    $(".GuardarNuevoCliente").click(function (){        
        $(".error").remove();		
        if( $("#TxtRFC").val() == "" ){
            $("#TxtRFC").focus().after("<span class='error'>Escriba el Registro Federal de Contribuyentes del cliente *(Requerido).</span>");         
            return false;
        }else if( $("#TxtNombreCliente").val() == "" ){
            $("#TxtNombreCliente").focus().after("<span class='error'>Escriba el nombre del cliente *(Requerido).</span>");			
            return false;
        }else if($("#TxtCalle").val() == ""){
            $("#TxtCalle").focus().after("<span class='error'>Por favor, escriba en que calle vive el cliente *(Requerido).</span>");
            return false;
        }else if($("#TxtColonia").val() == ""){
            $("#TxtColonia").focus().after("<span class='error'>Por favor, escriba el que colonia vive el cliente *(Requerido).</span>");
            return false;
        }
    });       

    $("#TxtNombreCliente, #TxtCalle, #TxtColonia").keyup(function(){
        if( $(this).val() != "" ){
            $(".error").fadeOut();			
            return false;
        }		
    });
});