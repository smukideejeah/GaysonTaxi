<?php
    session_start();
    require_once("conexion.php");
    $con = connect::conn();
    if($con){
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        if(strcmp($pass1,$pass2)){
            $sql ="update usuario set contrasenia = ? where usuario like ?";
            $stmt = sqlsrv_query($con,$sql,array(sha1($pass1),$_SESSION['user']));
            if($stmt){
                echo "si";
            }
        }echo "Contraseñas no coinciden";
    }else echo "Error en la conexion";
?>