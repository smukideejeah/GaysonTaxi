<?php
    session_start();
    require_once('../php/conexion.php');
    $con = connect::conn();
    if(isset($_SESSION['usuario'])){
        $user = $_SESSION['usuario'];
            if($con){
            $vari = "select * from favorito where usuario=?";
            $cone = array($user['usuario']);
            $stmt = sqlsrv_query($con,$vari,$cone);
            if($stmt==FALSE){
                echo "consulta incorrecta";
            }
            else{
                $row=0;
                while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    $favorito[] = array("titulo"=>$row['titulo']);

                if(count($favorito)==0){
                    echo "0";
                }else{
                    $json = json_encode($favorito);
                    $_SESSION['favorito'] = $favorito;
                    echo $json;
                }
            } 
        }else echo "No se establecio la conexion";
    }else echo "Variable NO establecida";


