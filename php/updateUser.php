<?php

include 'connect.php';

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];

if(isset($id) && isset($titulo) && isset($descripcion)){
    $titulo = $mysqli->real_escape_string($titulo);
    $descripcion = $mysqli->real_escape_string($descripcion);

    $query = "UPDATE tasks SET titulo = '$titulo', descripcion = '$descripcion' WHERE id = '$id'";
    $result = $mysqli->query($query);

    if(!$result){
        die('Query Error' . $mysqli->error);
    }

}

$response = array(
    'id' => $id,
    'titulo' => $titulo,
    'descripcion' => $descripcion
);

$jsonstring = json_encode($response);
header('Content-Type: application/json');
echo $jsonstring;

?>