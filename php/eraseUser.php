<?php

include 'connect.php';

$id = $_POST['id'];

if(isset($id)){
    $query = "DELETE FROM tasks WHERE id = '$id'";
    $result = $mysqli->query($query);

    if(!$result){
        die('Query Error' . $mysqli->error);
    }
}
?>