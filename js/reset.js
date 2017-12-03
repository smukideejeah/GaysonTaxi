var ip = "http://192.168.1.2";
$(document).ready(function (e) {
    $.ajax({
        url: '../php/sessions.php',
        success: function (e) {
            if (e == "0") location.href = ip+"/index.html";
        }
    });

    $("#reset").submit(function (e) {
        $.ajax({
            url: '../php/reset.php',
            type: 'post',
            data: $("#reset").serialize(),
            success: function (e) {
                if (e == "si") {
                    location.href = ip+"/login.html";
                } else {
                    alert(e);
                }
            }
        });
        return false;
    });
});