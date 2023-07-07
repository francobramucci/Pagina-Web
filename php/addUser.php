<?php

include 'connect.php';

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];

if(isset($titulo) && isset($descripcion)){
    $titulo = $mysqli->real_escape_string($titulo);
    $descripcion = $mysqli->real_escape_string($descripcion);

    if(!empty($titulo) && !empty($descripcion)){
        $query = "INSERT into tasks(user,titulo,descripcion) 
                  VALUES('" . $_SESSION['user_id'] . "', '$titulo', '$descripcion')";
        $result = $mysqli->query($query);

        if(!$result){
            die('Query Error' . $mysqli->connect_error);
        }
        echo "Task Added Succesfully";
    }
}
?>