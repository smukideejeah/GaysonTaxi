<?php
    session_start();
require_once('../php/conexion.php');
$conect = connect::conn();
$user = $_SESSION['usuario'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "insert into favorito (titulo,dir_destino,usuario) values ('".$_POST['titulo']."','".$_POST['Dir_destino']."','".$user['usuario']."')";
    $arr = $_SESSION['favorito'];
    $bool = TRUE;
    foreach($arr as $val) 
        if(strcmp($val['titulo'],$_POST['titulo'])==0) 
            $bool = FALSE;
    if($bool == true){
        $favo = sqlsrv_query($conect,$sql);
        if($favo){
            echo 'Inserccion correcta';
        }
        else{
            echo 'fallo al insertar el favorito';
        }
    }else echo "Debes poner otro titulo";
}else{
    print "aqui la estabas cagando";
}
?>
