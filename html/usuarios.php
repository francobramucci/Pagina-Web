<?php
    session_start();

    if(!$_SESSION['admins']){
        header("Location: http://200.3.127.46:8002/~uno/html/formulario.php");
    }

    if (!isset($_SESSION['tiempo'])) {
        $_SESSION['tiempo']=time();
    }
    else if (time() - $_SESSION['tiempo'] > 300) {
        session_destroy();
        header("Location: http://200.3.127.46:8002/~uno/html/log.php");
        die();  
    }
    $_SESSION['tiempo']=time();
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
    <title>Usuarios</title>
</head>
<body>
    <header> 
        <div class="guia">
            <a href="formulario.php">Formulario</a>
            <a href="../index.html">Integrantes</a>
            <a href="../php/logout.php">Cerrar Sesion</a>
        </div>
        <h1 class="titulo">Usuarios</h1>
        <a href="http://www.ips.edu.ar" target="_blank"><img src="assets/polinegativo.jpg" alt="Politécnico" class="logopoli"></a>
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
                        <th>Bloqueado</th>
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