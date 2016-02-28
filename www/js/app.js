localStorage["host"] = "http://127.0.0.1/GrupoInn/mobile/";

$('#login').submit(function () {

    // recolecta los valores que inserto el usuario
    var datosUsuario = $("#username").val();
    var datosPassword = $("#password").val();

    $.getJSON(localStorage["host"] + "php/manage.php", {option: 'login', username: datosUsuario, password: datosPassword}, function (data)
        {
            if (data.status == "OK") {

                    /// si la validacion es correcta, muestra la pantalla "home"
                    localStorage["idUsuario"] = data.id;


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
        if(true){
            for (var i = data.length - 1; i >= 0; i--) {
            html = html +'<li class="ui-li-has-count ui-li-has-thumb ui-last-child"><a data-ajax="false" href="detail.html?idEvent='+data[i].id+'" class="ui-btn ui-btn-icon-right ui-icon-carat-r"><img src="'+data[i].image+'"><h2>'+data[i].name+'</h2><p>'+data[i].description+'</p><span class="ui-li-count ui-body-inherit">'+data[i].num_p+'</span></a></li>';
            };
            $( "#feed-list" ).append( html );    
        }else{
            html = '<span>No hay actividades disponibles. </span>';
            $( "#feed-content" ).empty();
            $( "#feed-content" ).append( html );
        }
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

function detailLoad()
{
    var get = getGET();


    $.getJSON(localStorage["host"] + "php/manage.php",{option: "detail", idEvent: get['idEvent']}, function(data)
    {
        var html = '';
        if (data.status == 'OK') 
        {
            html = html + '<img src="'+data.image+'" class="band"></img><div class="info">';
            html = html + '<h2>'+data.name+'</h2><label class="culture">'+data.type+'</label>';
            html = html + '<button class="ui-btn ui-btn-a ui-corner-all">Unirte</button><p>'+data.description+'</p></div>';
            html = html + '<ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">';
            html = html + '<li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-inherit ui-li-has-count ui-first-child">Participantes <span class="ui-li-count ui-body-inherit">2/'+data.quota+'</span></li>';
            html = html + '<li class="ui-li-static ui-body-inherit ui-li-has-thumb"><img src="http://127.0.0.1/image/perfil-1.png"><h2>Participante 1</h2></li><li class="ui-li-static ui-body-inherit ui-li-has-thumb"><img src="http://127.0.0.1/image/perfil-2.png"><h2>Participante 2</h2></li></ul>';
        }else
        {
            html = html + '<span>No hay informacion de este evento. </span>'
        }
        $("#detail-content").append(html);
    });
}

$('#register').submit(function () {

    // recolecta los valores que inserto el usuario
    var datosUsuario = $("#email").val();
    var datosPassword = $("#phone").val();

    $.getJSON(localStorage["host"] + "php/manage.php", {option: 'register', username: datosUsuario, password: datosPassword}, function (data)
        {
            if (data.status == "OK") {

                    /// si la validacion es correcta, muestra la pantalla "home"
                    localStorage["idUsuario"] = data.id;


                    window.location.href = 'home.html';

                } else {

                    alert("Validacion incorrecta, verifique los datos");
                }
        });
});

function getGET(){
   var loc = document.location.href;
   var getString = loc.split('?')[1];
   var GET = getString.split('&');
   var get = {};//this object will be filled with the key-value pairs and returned.

   for(var i = 0, l = GET.length; i < l; i++){
      var tmp = GET[i].split('=');
      get[tmp[0]] = unescape(decodeURI(tmp[1]));
   }
   return get;
}
