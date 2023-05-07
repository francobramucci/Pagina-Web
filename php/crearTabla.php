GNU nano 5.4                                crearTabla.php                                         
<?php

require_once 'connect.php';

$mysqli->query("CREATE TABLE
                usuarios (id INT AUTO_INCREMENT PRIMARY KEY,
                nombre TEXT NOT NULL,
                apellido VARCHAR(80) NOT NULL,
                dni TEXT NOT NULL)")
        or die($mysqli->error);

$mysqli->close();



