<?php

include 'connect.php';

$mysqli->query("CREATE TABLE
                usuarios (id INT AUTO_INCREMENT PRIMARY KEY,
                nombre TEXT NOT NULL,
                apellido VARCHAR(80) NOT NULL,
                dni TEXT NOT NULL,
                email TEXT NOT NULL)")
        or die($mysqli->error);

$mysqli->close();



