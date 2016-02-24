localStorage["host"] = "http://127.0.0.1/mobile/";

$('#login').submit(function () {

    // recolecta los valores que inserto el usuario
    var datosUsuario = $("#username").val();
    var datosPassword = $("#password").val();

    $.getJSON(localStorage["host"] + "php/login.php", {usuario: datosUsuario, password: datosPassword})
            .done(function (respuestaServer) {

                if (respuestaServer.validacion == "ok") {

                    /// si la validacion es correcta, muestra la pantalla "home"
                    //localStorage["usuario"] = respuestaServer.usuario;
                    localStorage["idUsuario"] = respuestaServer.idUsuario;


                    window.location.href = 'home.html';

                } else {

                    alert("Validacion incorrecta, verifique los datos");
                }
            })
    return false;
});

function cerrarSesion() {
    localStorage.removeItem("idUsuario");
    location.href = 'index.html';
}


$('#evento').submit(function () 
	{
		var datosNombre = $('nombreEvento').val();
		var datosTipo = $('tipoEvento').val();
		var datosLugar = $('lugarEvento').val();
		var datosFecha = $('fechaEvento').val();
        alert("Prueba");

        $.post(localStorage["host"] + "php/evento.php", {nombre: datosNombre, tipo: datosTipo}, 
            function (data){
                
            }, "json")


	});

function feedload()
{
    $.getJSON(localStorage["host"] + "php/manage.php",{option: "feed"}, function (data)
    {
        var html = '';
        for (var i = data.length - 1; i >= 0; i--) {
            html = html +'<li class="ui-li-has-count ui-li-has-thumb ui-last-child"><a href="details.html?'+data[i].id+'" class="ui-btn ui-btn-icon-right ui-icon-carat-r"><img src=""><h2>'+data[i].name+'</h2><p>'+data[i].description+'</p><span class="ui-li-count ui-body-inherit">12</span></a></li>';
        };
        $( "#feed" ).append( html );
    });
} 

