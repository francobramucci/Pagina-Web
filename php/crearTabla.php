<?php

    include 'connect.php';

    $mysqli->query("CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user TEXT NOT NULL,
        nombre TEXT NOT NULL,
        apellido VARCHAR(80) NOT NULL,
        dni TEXT NOT NULL,
        email TEXT NOT NULL
    )")or die($mysqli->error);

    $mysqli->close();

    $users->query("CREATE TABLE accounts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email TEXT NOT NULL,
        pass TEXT NOT NULL
    )") or die($users->error);

    $users->close();

?>