<?php

    include '.config.php';

    $HOST = "localhost";
    $USER = "uno";
    //$PASS almacenado en archivo protegido
    $DB = "uno";

    $mysqli = new mysqli($HOST, $USER, $PASS, $DB);

    if($mysqli->connect_error) {
        die('Error de Conexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
    else{
        //echo "Conexion exitosa a la base de datos\n";
    }

    if (!isset($_SESSION)) { //La sesión se mantiene iniciada en cada página (ya que connect.php está incluido en todas)
        session_start();
    }
?>
