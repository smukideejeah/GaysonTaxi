<?php

session_start();
require_once("conexion.php");
$con = connect::conn();
if($con){
    $token = $_GET['token'];
    $id = $_GET['iduser'];

    $sql ="select * from restaurar";
    $stmt = sqlsrv_query($con,$sql);

    $fila = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

    if(strcmp($id,sha1($fila['iduser'])){
        $_SESSION['user'] = $fila['username'];
        header('Location:../reset.html');
    }else echo "Hubo un problema";

}else echo "Error en la conexion";
