<?php

    include '.config.php';

    $HOST = "localhost";
    $USER = "uno";
    //$PASS almacenado en archivo protegido
    $DB = "uno";
    $DB2 = "uno2";

    $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
    $users = new mysqli($HOST, $USER, $PASS, $DB2);

    if ($mysqli->connect_error) {
        die('Error de Conexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    } else if ($users->conecct_error){
        die('Error de Conexion (' . $users->conecct_errno . ') ' . $users->connect_error);
    } else{
        //echo "Conexion exitosa a la base de datos\n";
    }
?>