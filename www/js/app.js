localStorage["host"] = "http://127.0.0.1/GrupoInn/mobile/";

$('#login').submit(function () {

    // recolecta los valores que inserto el usuario
    var datosUsuario = $("#username").val();
    var datosPassword = $("#password").val();

    $.getJSON(localStorage["host"] + "php/manage.php", {option: 'login', username: datosUsuario, password: datosPassword}, function (data)
        {
            if (data.status == "OK") {

                    /// si la validacion es correcta, muestra la pantalla "home"
                    //localStorage["usuario"] = data.usuario;
                    localStorage["idUsuario"] = data.idUser;


                    window.location.href = 'home.html';

                } else {

                    alert("Validacion incorrecta, verifique los datos");
                }
        });
});

function cerrarSesion() {
    localStorage.removeItem("idUsuario");
    location.href = 'index.html';
}


function feedLoad()
{
    $.getJSON(localStorage["host"] + "php/manage.php",{option: "feed"}, function (data)
    {
        var html = '';
        for (var i = data.length - 1; i >= 0; i--) {
            html = html +'<li class="ui-li-has-count ui-li-has-thumb ui-last-child"><a data-ajax="false" href="detail.html?'+data[i].id+'" class="ui-btn ui-btn-icon-right ui-icon-carat-r"><img src=""><h2>'+data[i].name+'</h2><p>'+data[i].description+'</p><span class="ui-li-count ui-body-inherit">12</span></a></li>';
        };
        $( "#feed" ).append( html );
    });
} 

function notificationLoad()
{
    $.getJSON(localStorage["host"] + "php/manage.php",{option: "notification", idUser: 1}, function (data)
    {
        var html = '';
        if(data.status == 'EMPTY' )
        {
            html = html + '<span>No hay notificaciones disponibles. </span>';
        }
        $("#notifications").append( html );
    });
}

function profileLoad()
{
    $.getJSON(localStorage["host"] + "php/manage.php",{option: "profile", idUser: 1}, function (data)
    {
        var html = '';
        if(data.status == 'OK' )
        {
            html = html + '<img class="circle" src="'+data.image+'"><h2>'+data.names+'</h2>';
        }
        html = html + '<div><button class="ui-btn ui-btn-inline">Extrovertido</button><button class="ui-btn ui-btn-inline"><i class="fa fa-plus fa-lg"></i>Agregar Gustos</button></div>';
        $("#profile").append( html );
    });
}
