<?php

    include 'connect.php';

    $mysqli->query("CREATE TABLE
        usuarios (id INT AUTO_INCREMENT PRIMARY KEY,
        user INT,
        nombre TEXT NOT NULL,
        apellido VARCHAR(80) NOT NULL,
        dni TEXT NOT NULL,
        email TEXT NOT NULL
    )")or die($mysqli->error);

    $mysqli->query("CREATE TABLE
        accounts (id INT AUTO_INCREMENT PRIMARY KEY,
        email TEXT NOT NULL,
        pass TEXT NOT NULL,
        sign_date TEXT NOT NULL,
        last_log TEXT NOT NULL,
        cant_log INT,
        admins TINYINT,
        bloq TINYINT,
        bloq_text TEXT NOT NULL
    )") or die($mysqli->error);

    $mysqli->query("CREATE TABLE
        tasks (id INT AUTO_INCREMENT PRIMARY KEY,
        user INT,
        titulo TEXT NOT NULL,
        descripcion TEXT NOT NULL
    ")

    $mysqli->close();

?>