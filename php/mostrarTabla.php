<?php

    include 'connect.php';

    $result = $mysqli->query("SELECT * from usuarios /*where user = '$_SESSION['user_id']'*/");

    $json = array();

    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $json[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'dni' => $row['dni'],
            'email' => $row['email']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>