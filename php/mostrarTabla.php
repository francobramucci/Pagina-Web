<?php

    include 'connect.php';

    if($_SESSION['admins']){
        $result = $mysqli->query("SELECT * FROM usuarios");
    } else {
        $result = $mysqli->query("SELECT * FROM usuarios WHERE user = '" . $_SESSION['user_id'] . "'");
    }
    

    $json = array();

    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $json[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'dni' => $row['dni'],
            'email' => $row['email'],
            'user' -> $row['user']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>