<?php

    include 'connect.php';

    $rowsql="INSERT INTO usuarios (nombre,apellido,dni,email) VALUES('Juan Carlos','Gado','12345678','juancagado@gmail.com')";

    if($mysqli->query($rowsql) === TRUE){
        echo "Datos agregados correctamente";
    }
    else{
        echo "Error" . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
?>