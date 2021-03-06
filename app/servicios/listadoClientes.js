var serviceURL = "http://www.uruapanmovil.com/ventas/app/servicios/";
var Clientes;
$(document).delegate('#PaginaListaClientes', 'pageshow', function(event) {
    ObtenerListadoClientes();
});

function ObtenerListadoClientes() {
    var id = localStorage.getItem("id_cliente");
    $.getJSON(serviceURL + 'listadoClientes.php?id=' + id , function(data) {
        $('#features_list_detailed li').remove();
        Clientes = data.items;
        $.each(Clientes, function(index, Cliente) {
                $('#features_list_detailed').append('<li>' +
                    '<div class="feat_small_icon"><img src="images/icons/black/user.png" alt="" title="" /></div>' + 
                        '<div class="feat_small_details">' +
                        '<h4>'+ Cliente.Nombre +'</h4>' +
                        '<a href="detalleCliente.html">'+ Cliente.Direccion +'</a>'+
                        '</div>'+
                    '<div class="view_more">'+
                    '<a href="detalleCliente.html"><img src="images/load_posts_disabled.png" alt="" title="" /></a>'+
                    '</div></li>');                
        });		
        $('#features_list_detailed').listview('refresh');
    });
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}