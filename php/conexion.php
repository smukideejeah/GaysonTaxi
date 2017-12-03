<?php
    class connect{
        static function conn(){
            $arr = array("Database"=>"gayson","UID"=>"sa","PWD"=>"1234");
            $data = sqlsrv_connect("localhost",$arr);
            return $data;
        }
    }
?>