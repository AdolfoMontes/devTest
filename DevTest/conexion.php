<?php

class ConexionDB{

    public static function ConexionBD(){
        $host='localhost';
        $dbname='DBvotaciones';
        $username='root';
        $pasword ='';
        $puerto=1433;

        try{
            $conn = new PDO ("sqlsrv:Server=$host,$puerto;Database=$dbname",$username,$pasword);
        }catch(PDOException $ex){
            echo ("Sin conexión a base de datos: $dbname, error: $ex");
        }
        return $conn;
    }
}

?>