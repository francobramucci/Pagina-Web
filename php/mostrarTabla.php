<?php

include 'connect.php';

$search = $_POST['search'];
$search = $mysqli->real_escape_string($search);

if($_SESSION['admins']){
    $result = $mysqli->query("SELECT * FROM tasks WHERE titulo LIKE '" . $search . "%'");
} else {
    $result = $mysqli->query("SELECT * FROM tasks WHERE user = '" . $_SESSION['user_id'] . "' AND titulo LIKE '". $search . "%'");
}

if (!$result) {
    die('Query Error'. $mysqli->error);    
}

$json = array();

while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $json[] = array(
        'id' => $row['id'],
        'user' => $row['user'],
        'titulo' => $row['titulo'],
        'descripcion' => $row['descripcion']
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>