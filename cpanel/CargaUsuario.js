window.onload = function (e) {

    $.ajax({
        url: "DatosUsuario.php",
        success: function (regreso) {
            if (regreso != 0) {
                var x = document.getElementById("sal");
                x.innerHTML = "Bienvenido " + regreso;
                user = regreso;
                nobackbutton();
            } else {
                location.href = "http://192.168.1.18/login.html";
            }
        }
    });
    $.ajax({
        url: "ObtenerHistorial.php",
        success: function (idea) {
            var dato = JSON.parse(idea);
            var s;
            s = "<tr class='titulo'>" +
                "<td>Direccion Origen</td><td>Direccion Destino</td><td>Fecha</td><td>Progreso</td>"
            + "</tr>";
            $.each(dato, function (i, item) {
                var lis;
                if (dato[i].progreso == "1") {
                    lis = "En camino";
                } else {
                    lis = "Listo";
                }
                s += "<tr class:'trt'>" +
                    "<td>" + dato[i].origen + "</td>" +
                    "<td>" + dato[i].destino + "</td>" +
                    "<td>" + dato[i].fecha.date + "</td>" +
                    "<td>" + lis + "</td>" +
                    "<td><button class='b'>Ver</button></td>"
                + "</tr>";
            }); $("#td1").append($("<table class='table1'>" + s + "</table>"));
        }
    });
    $.ajax({
        url: "obtenerFavoritos.php",
        success: function (idea) {
            var dato = JSON.parse(idea);
            var s = "<br>";
            $.each(dato, function (i, item) {
                s += "<tr class:'trt'>" +
                    "<td><a href='#' class='favoritos'>" + dato[i].titulo + "</a></td>" +
                    "<td><button class='b'>Solicitar</button></td>"
                + "</tr>";
            }); $("#td2").append($("<table class='table1' valing='center' style='width:95%; margin:0 auto;'>" + s + "</table>"));
        }
    });
    $.ajax({
        url: "obtenerCotidiano.php",
        success: function (idea) {
            var dato = JSON.parse(idea);
            var s;
            s = "<tr class='titulo'>" +
                "<td>Direccion Origen</td><td>Direccion Destino</td><td>Estado</td>"
            + "</tr>";
            $.each(dato, function (i, item) {
                var final;
                var col, value, size;

                if (dato[i].color == 0) {
                    col = 'red';
                    value = "Inactivo";
                    size = "75";
                }
                else {
                    col = 'green';
                    value = "Activado";
                    size = "75";
                }

                if (dato[i].estado == 1111111) final = "Diario";
                else final = "Por dias";
                s += "<tr class:'trt' >" +
                    "<td>" + dato[i].origen + "</td>" +
                    "<td>" + dato[i].destino + "</td>" +
                    "<td>" + final + "</td>" +
                    "<td><button class='active'  id='active"+dato[i]+"' onclick='cambio(" + dato[i].id + ",this)' style='background-color:" + col + ";width = " + size + ";'>" + value + "</button></td>" +
                    "<td><button class='b'>Editar</button></td>"
                + "</tr>";
            }); $("#td3").append($("<table class='table1'>" + s + "</table>"));
        }
    });

}

function cambio(id,active) {
    if (active.style.backgroundColor == "red") {
        var sub = document.getElementById('subtitulo');
            active.style.backgroundColor = "green";
            active.innerHTML = "Activado";
            active.style.width = "75px";
            var js = JSON.parse('{"id":'+id+',"val":1}');
            $.ajax({
                type: 'post',
                url: 'edita.php',
                data: js
            });
        }else { 
            active.style.backgroundColor = "red";
            active.innerHTML = "inactivo";
            active.style.width = "75px";
            var js = JSON.parse('{"id":'+id+',"val":0}');
             $.ajax({
                type: 'post',
                url: 'edita.php',
                data: js
            });
        }
}
var flag= 1;
function menu(id) {
    var menu = document.getElementById(id);
    if (flag == 1) {
            menu.style.display = "block";
            flag = 0;
        } else if (flag == 0) {
            menu.style.display = "none";
            flag = 1;
        }
}
function salir(){
    $.ajax({
        url: "destroy.php",
        success: function (e) {
            location.href = 'http://192.168.1.18';
        }

    });
}
function nobackbutton(){
   window.location.hash="no-back-button";	
   window.location.hash="Again-No-back-button" //chrome	
   window.onhashchange=function(){window.location.hash="no-back-button";}	
}
