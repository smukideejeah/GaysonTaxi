<?php
    session_start();
require_once("conexion.php");
$con = connect::conn();
if($con){
    $user = $_POST['user'];
    $pass = sha1($_POST['password']);
    $sql = "select * from usuario where usuario like ? and contrasenia like ?;";
    $consulta = sqlsrv_query($con,$sql,array($user,$pass));
    if($consulta===false){
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
    }else{
        $fila = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC);
        if(count($fila)>0){
            echo $fila['usuario'];
            $_SESSION['usuario'] = $fila;
        }else{
            echo "0";
        }
    }

}else{
    echo "Error en el servidor";
}


?>