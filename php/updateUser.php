<?php
    include 'connect.php';

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];

    if(isset($id) && isset($nombre) && isset($apellido) && isset($dni) && isset($email)){
        $query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', dni = '$dni', email = '$email' WHERE id = '$id'";
        $result = $mysqli->query($query);

        if(!$result){
            die('Query Error' . $mysqli->error);
        }
        echo "Task has been updated";
    }
?>