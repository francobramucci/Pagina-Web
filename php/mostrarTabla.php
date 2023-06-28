<?php

include 'connect.php';

$search = $_POST['search'];
$search = $mysqli->real_escape_string($search);

if($_SESSION['admins']){
    $result = $mysqli->query("SELECT * FROM usuarios WHERE nombre LIKE '" . $search . "%'");
} else {
    $result = $mysqli->query("SELECT * FROM usuarios WHERE user = '" . $_SESSION['user_id'] . "' AND nombre LIKE '". $search . "%'");
}

if (!$result) {
    die('Query Error'. $mysqli->error);    
}

$json = array();

while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $json[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'dni' => $row['dni'],
        'email' => $row['email'],
        'user' => $row['user']
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>