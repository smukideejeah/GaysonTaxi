var ip = "http://192.168.1.18";
window.onload = function (e) {
    $.ajax({
        url: ip+'/php/inicio.php',
        success: function (e) {
            if (e != "0") {
                location.href = e;
            }
        }
    });
}