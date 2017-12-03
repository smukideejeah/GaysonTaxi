<?php
require_once("conexion.php");
$con = connect::conn();
if($con){
    $nombre = $_POST['name'];
    $apellido = $_POST['ape'];
    $sexo = $_POST['sex'];
    $correo = $_POST['mail'];
    $usuario = $_POST['user'];
    $pass = $_POST['pass'];
    $conf = $_POST['cpass'];
    $tel = $_POST['tel'];
    $nac = $_POST['nac'];
    if(strcmp($pass,$conf) ==0){
        $sqlmail = "select correo from usuario where correo like '".$correo."';";
        $sqluser = "select usuario from usuario where usuario like '".$usuario."';";
        $stat = sqlsrv_query($con,$sqlmail);
        $fil = sqlsrv_fetch_array($stat,SQLSRV_FETCH_ASSOC);
        if(count($fil)==0){
            $stat2 = sqlsrv_query($con,$sqluser);
             $fil = sqlsrv_fetch_array($stat2,SQLSRV_FETCH_ASSOC);
            if(count($fil)==0){
                $sql = "insert into usuario (nombres,apellidos,sexo,correo,usuario,contrasenia,telefono,nacimiento,confirmado,foto) values(?,?,?,?,?,?,?,?,?,?);";
                $consulta = sqlsrv_query($con,$sql,array($nombre,$apellido,$sexo,$correo,$usuario,sha1($pass),$tel,$nac,1,''));
                if($consulta){
                    echo "Usuario Registrado";
                    header('location; http://192.168.0.2/login.html');
                }
                else
                    if( ($errors = sqlsrv_errors() ) != null) {
                        foreach( $errors as $error ) {
                            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                            echo "code: ".$error[ 'code']."<br />";
                            echo "message: ".$error[ 'message']."<br />";
                        }
                    }

            }else echo "El usuario ya esta en uso";
        }else echo "EL correo ya esta en uso";
    }else echo "Las contrasenias no coinciden";
}else echo "Error en el servidor";

?>