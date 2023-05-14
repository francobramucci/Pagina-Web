<?php
    include 'connect.php';

    $id = $_POST['id'];

    if(isset($id)){
        $query = "SELECT * FROM usuarios WHERE id = $id";
        $result = $mysqli->query($query);

        if(!$result){
            die('Query Error' . $mysqli->error);
        }

        $json = array();
        while($row = $result->fetch_array()){
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
    }
?>