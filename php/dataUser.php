<?php
    include 'connect.php';

    $id = $_POST['id'];

    if(isset($id)){
        $query = "SELECT * FROM tasks WHERE id = $id";
        $result = $mysqli->query($query);

        if(!$result){
            die('Query Error' . $mysqli->error);
        }

        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'descripcion' => $row['descripcion']
            );
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;
    }
?>