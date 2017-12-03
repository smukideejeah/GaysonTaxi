<?php
session_start();
require_once('../php/conexion.php');
$conect = connect::conn();
$user = $_SESSION['usuario'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $sql = "insert into cotidiano (dir_origen,dir_destino,semana,hora,usuario,estado) values (?,?,?,?,?,?);";
    $favo = sqlsrv_query($conect,$sql,array($_POST['Dir_o'],$_POST['Dir_d'],$_POST['semana'],$_POST['reloj'],$user['usuario'],1));
    if($favo){
        echo 'Inserccion correcta';
    }
    else{
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
    }
}else{
    print "aqui la estabas cagando";
}
?>
