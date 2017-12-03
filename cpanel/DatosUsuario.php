<?php
session_start();
 if(isset($_SESSION['usuario'])){
        $user = $_SESSION['usuario'];
        echo $user['nombres'];
 }else{
    echo "0";    
 }
 
?>
