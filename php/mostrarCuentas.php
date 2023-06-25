<?php

    include 'connect.php';

    $result = $mysqli->query("SELECT * from accounts");

    $json = array();

    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $json[] = array(
            'id' => $row['id'],
            'email' => $row['email'],
            'pass' => $row['pass'],
            'sign_date' => $row['sign_date'],
            'last_log' => $row['last_log'],
            'cant_log' => $row['cant_log'],
            'admins' => $row['admins'],
            'bloq' => $row['bloq'],
            'bloq_text' => $row['bloq_text']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>