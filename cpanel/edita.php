<?php
    session_start();
    require_once('../php/conexion.php');
    $con = connect::conn();
    if(isset($_SESSION['usuario'])){
        $user = $_SESSION['usuario'];
        if((isset($_POST['id']))&&(isset($_POST['val']))){
            $id = $_POST['id'];$val = $_POST['val'];
            $sql = "update cotidiano set estado = ? where id = ?";
            $stmt = sqlsrv_query($con,$sql,array($val,$id));
            if($stmt==FALSE){
                echo "Error";
            }else{
                echo "Listo";
            }
        }else echo "id no enviado";
    }else echo "Variable NO establecida";
?>