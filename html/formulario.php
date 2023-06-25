<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: http://200.3.127.46:8002/~uno/html/sign.php");
    }

    if (!isset($_SESSION['tiempo'])) {
        $_SESSION['tiempo']=time();
    }
    else if (time() - $_SESSION['tiempo'] > 120) {
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
    <script src="userform.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Formulario</title>
</head>
<body>
    <header> 
        <div class="guia">
            <a href="formulario.php">Formulario</a>
            <a href="../index.html">Integrantes</a>
            <a href="../php/logout.php">Cerrar Sesion</a>
            <?php if($_SESSION['admins']): ?>
                <a href="usuarios.php">Usuarios</a>
            <?php endif; ?>
        </div>
        <h1 class="titulo">Formulario</h1>
        <a href="http://www.ips.edu.ar" target="_blank"><img src="assets/polinegativo.jpg" alt="Politécnico" class="logopoli"></a>
    </header>

    <div class="todo">
        <!-- FORMULARIO -->
        <form id="user-form">
            <div>
                <input type="hidden" id="userId">
                <input type="text" id="userName" placeholder="Nombre Completo">
                <input type="text" id="userLastname" placeholder="Apellido">
                <input type="number" id="dni" placeholder="DNI">
                <input type="email" id="userEmail" placeholder="E-mail">
                <button type="submit">Guardar datos</button>
            </div>
        </form>

        <!-- TABLA -->
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>                        
                        <th>E-mail</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="all-users"></tbody>
            </table>
        </div>

        <!-- BUSCAR -->
        <div class="buscar">
            <input id="search" type="search" placeholder="Buscar tu nombre">
            <div id="user-result" class="lista"></div>
        </div>
    </div>
</body>
</html>