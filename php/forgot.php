<?php
    require_once('conexion.php');
       if(isset($_POST['user'])){
    $user = $_POST['user'];
    $con = connect::conn();
    if($con){
        $sql = "select id,usuario,correo from usuario where usuario = ?";
        $stmt = sqlsrv_query($con,$sql,array($user));
        if($stmt === FALSE){
            echo "Error en la consulta";
        }else{
            $fila = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
            if(count($fila)>0){
                $mail = $fila['correo'];
                $str = $fila['id'].$fila['usuario'].rand(1,9999999).date("y-m-d");
                $token = sha1($str);
                $res = sqlsrv_query($con,'insert into restaurar values(?,?,?,?);',array($fila['id'],$fila['usuario'],$token,date("y-m-d")));
                if($res === FALSE){
                    echo 'Insercion no realizada';
                }else{
                    $link = $_SERVER["SERVER_NAME"].'/php/confirmReset.php?iduser='.sha1($fila['id']).'&token='.$token;
                    $mensaje = '<html>
                     <head>
                        <title>Restablece tu contraseña</title>
                     </head>
                     <body>
                       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
                       <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
                       <p>
                         <strong>Enlace para restablecer tu contraseña</strong><br>
                         <a href="'.$link.'"> Restablecer contraseña </a>
                       </p>
                     </body>
                    </html>'; // Para enviar un correo HTML, debe establecerse la cabecera Content-type
                    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                   if(mail($mail, "Recuperar contraseña", $mensaje,$cabeceras)){
                       echo "Se ha enviado un correo con una confimacion de cambio de contraseña";
                   }else{
                       echo "Error en envio de correo";
                   }
                   
                }
            }else echo "Usuario no encontrado";
        }
    }else echo "Error en la conexion";
}else echo "Error en post";
