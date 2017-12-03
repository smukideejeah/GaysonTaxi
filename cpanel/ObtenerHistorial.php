<?php
require_once("../php/conexion.php");
session_start();
if(isset($_SESSION['usuario'])){
       $user =$_SESSION['usuario'];
}
$con = connect::conn();
if($con){
    $vari = "select * from historial where usuario=? order by id desc";
    $cone = array($user['usuario']);
    $stmt = sqlsrv_query($con,$vari,$cone);
    if($stmt==FALSE){
        echo "consulta incorrecta";
    }
    else{
        $row=0;
        while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            $historial[] = array("id"=>$row['id'],"origen"=>$row['dir_origen'],"destino"=>$row['dir_destino'],"fecha"=>$row['fecha_sol'],"taxista"=>$row['taxista'],"progreso"=>$row['progreso']);
        if(count($historial)==0){
            echo "0";
        }else{
            $json = json_encode($historial);
            echo $json;
        }
    } 
}
else{
    echo 'Error en conexion de labs base de datos';
}
?>
