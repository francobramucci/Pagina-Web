<?php

    //En este archivo php nos encargaremos de buscar y devolver las tareas
    //al frontend con un determinado nombre.

    include 'connect.php';

    $search = $_POST['search'];
    
    //isset: determina si una variable está definida y no es null.
    if (isset($search)) {
        //Con real_escape_string evitamos inyección SQL.
        $search = $mysqli->real_escape_string($search);
        if (!empty($search)) {
            $query = "SELECT * FROM usuarios WHERE nombre LIKE '$search%'";
            $result = $mysqli->query($query);
        
            if (!$result) {
                die('Query Error'. $mysqli->error);    
            }
            //Vamos a recorrer el resultado de la query para luego

            //escribir los datos recibidos en un formato JSON.
            $json = array();
            while ($row = $result->fetch_array()) {
                $json[] = array(
                    'nombre' => $row['nombre'],
                    'apellido' => $row['apellido'],
                    'dni' => $row['dni'],
                    'email' => $row['email']  
                );
            }
            //Para enviarlo al frontend necesito convertirlo a String. 
            //Por lo tanto, paso de JSON a String.
            //Luego, en el frontend lo que haré será volver a convertirlo a un JSON.
            $jsonstring = json_encode($json);
            echo $jsonstring; //El string con información que se manda al frontend.
        }
    } 