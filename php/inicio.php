<?php
session_start();
if(isset($_SESSION['usuario'])){
    echo 'http://192.168.1.18/cpanel';
}else echo "0";