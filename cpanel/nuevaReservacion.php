<?php
session_start();
date_default_timezone_set('America/Costa_Rica');
require_once('../php/conexion.php');
$con = connect::conn();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($con){
        $taxis = sqlsrv_query($con,'select carnet from taxista;');
        while($fila = sqlsrv_fetch_array($taxis,SQLSRV_FETCH_ASSOC))
            $taxistas[] = $fila['carnet'];
        $f = getdate();
        $fecha = $f['mday'].'/'.$f['mon'].'/'.$f['year']." ".($f['hours']).":".$f['minutes'].':'.$f['seconds'];
        
        $user = $_SESSION['usuario'];
        $sql = "insert into historial(dir_origen,dir_destino,fecha_sol,progreso,usuario,taxista) values (?,?,?,?,?,?)";
        $stmt = sqlsrv_query($con,$sql,array($_POST['Dir_o'],$_POST['Dir_d'],$fecha,1,$user['usuario'],$taxistas[rand(0,count($taxistas)-1)]));
        if($stmt){
            echo "Se ha reservado un taxi";
        }else{
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
        }
    }else echo "Error al conectar";
}
