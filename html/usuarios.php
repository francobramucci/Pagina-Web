<?php
session_start();

if(!$_SESSION['admins'] || $_SESSION['bloq']){
    header("Location: http://200.3.127.46:8002/~uno/html/formulario.php");
    exit();
}

if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 300) {
    session_destroy();
    header("Location: http://200.3.127.46:8002/~uno/html/log.php");
    exit();
}
$_SESSION['tiempo'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="usuarios.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Formulario</title>
</head>
</head>
<body>
    <header>
        <details class="dropdown">
            <summary role="button">
                <div class="menu">
                    <span class="material-symbols-sharp">menu</span>
                    <a class="button">Menu</a>
                </div>
            </summary>
            <ul>
                <li><a href="formulario.php">Formulario</a></li>
                <li><a href="../index.html">Integrantes</a></li>
                <li><a href="../php/logout.php">Cerrar Sesion</a></li>
            </ul>
        </details>
        <h1 class="titulo" style="margin-right: 90px;">Usuarios</h1>
        <a href="http://www.ips.edu.ar" target="_blank"><img src="assets/polinegativo.jpg" alt="Politécnico"
                class="logopoli"></a>
    </header>

    <div class="todo">
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Fecha Registro</th>
                        <th>Ultima Sesion</th>                        
                        <th>Cant Sesiones</th>
                        <th>Razón Bloqueo</th>
                        <th>Admin</th>
                        <th>Bloquear/motivo</th>
                    </tr>
                </thead>
                <tbody id="all-accounts"></tbody>
            </table>
        </div>
    </div>
</body>
</html>