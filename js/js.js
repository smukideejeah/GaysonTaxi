var ip = "http://192.168.1.18";
$("#reg").submit(function (e) {

    $.ajax({
        type: 'post',
        url: ip+'/php/add.php',
        data: $("#reg").serialize(),
        success: function (dat) {
            alert(dat);
            location.href = ip+"/login.html";
        }
    });
    return false;
});
$("#log").submit(function (e) {
    $.ajax({
        type: 'post',
        url: ip+'/php/login.php',
        data: $("#log").serialize(),
        success: function (dat) {
            if (dat != "0") {
                location.href = ip+"/cpanel/";
            } else {
                alert("Usuario o Contraseña no validos");
            }
        }
    });
    return false;
});
function saber(){
    var cor = document.getElementById('correosu');
    var area = document.getElementById('textA');

    if (cor.value!=0 && area.value!=0) {
        alert("Se ha enviado su peticion");
        location.href = "contactanos.html";
           
    }
    else {
        alert("Se requiere llenar los campos"); 
    }
    
}
$("#forgot").submit(function (e) {
    $.ajax({
        type: 'post',
        url: ip+'/php/forgot.php',
        data: $("#forgot").serialize(),
        success: function (dat) {
            alert(dat);
        }
    });
    return false;
});