<?php

    include 'connect.php';

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];

    if(isset($nombre) && isset($apellido) && isset($dni) && isset($email)){
        $nombre = $mysqli->real_escape_string($nombre);
        $apellido = $mysqli->real_escape_string($apellido);
        $dni = $mysqli->real_escape_string($dni);
        $email = $mysqli->real_escape_string($email);

        if(!empty($nombre) && !empty($apellido) && !empty($dni) && !empty($email)){
            $query = "INSERT into usuarios(nombre,apellido,dni,email,user) VALUES('$nombre','$apellido','$dni','$email','$_SESSION['user_id']')";
            $result = $mysqli->query($query);

            if(!$result){
                die('Query Error' . $mysqli->connect_error);
            }
            echo "User Added Succesfully";
        }
    }
?>