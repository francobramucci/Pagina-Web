<?php

include 'connect.php';

$id = $_POST['id'];

if(isset($id)){
    $query = "DELETE FROM usuarios WHERE id = '$id'";
    $result = $mysqli->query($query);

    if(!$result){
        die('Query Error' . $mysqli->error);
    }
    //echo "Usuario eliminado pa";
}
?>