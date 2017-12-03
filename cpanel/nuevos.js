function envia(){
    $.ajax({
        type: 'post',
        url: 'NuevoFavorito.php',
        data: $("#fomlight").serialize(),
        success: function (dat) {
            alert(data);
        }
    });
    return false;
}

function enviaRes() {
    $.ajax({
        type: 'post',
        url: 'nuevaReservacion.php',
        data: $("#fomlight3").serialize(),
        success: function (dat) {
            alert(dat);
        }
    });

}

function enviaCot(){
    var ck = "";
    if ($('#ck1').prop('checked')==true) ck += "1";
    else if ($('#ck1').prop('checked')==false) ck += "0";
    if ($('#ck2').prop('checked')==true) ck += "1";
    else if ($('#ck2').prop('checked')==false) ck += "0";
    if ($('#ck3').prop('checked')==true) ck += "1";
    else if ($('#ck3').prop('checked')==false) ck += "0";
    if ($('#ck4').prop('checked')==true) ck += "1";
    else if ($('#ck4').prop('checked')==false) ck += "0";
    if ($('#ck5').prop('checked')==true) ck += "1";
    else if ($('#ck5').prop('checked')==false) ck += "0";
    if ($('#ck6').prop('checked')==true) ck += "1";
    else if ($('#ck6').prop('checked')==false) ck += "0";
    if ($('#ck7').prop('checked')==true) ck += "1";
    else if ($('#ck7').prop('checked')==false) ck += "0";

    var origen = $("#Dir_o").val();
    var destino = $("#Dir_d").val();
    var reloj = $("#reloj").val();
    var ar = '{"Dir_o":"' + origen + '","Dir_d":"' + destino + '","semana":"' + ck + '","reloj":"' + reloj + '"}';
    var js = JSON.parse(ar);
    $.ajax({
        type: 'post',
        url: 'nuevoCotidiano.php',
        data: js,
        success: function (e) {
            alert(e);
        }
    });
    return false;
}