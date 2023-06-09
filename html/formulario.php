<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: http://200.3.127.46:8002/~uno/html/log.php");
    exit();
}

if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 600) {
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
    <script src="userform.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="stylesheet" type="text/css" href="log.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Formulario</title>
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
                <li><a href="../index.html">Integrantes</a></li>
                <?php if($_SESSION['admins']): ?>
                <li><a href="usuarios.php">Usuarios</a></li>
                <?php endif; ?>
                <li><a id="warning" href="../php/logout.php">Cerrar Sesion</a></li>
            </ul>
        </details>
        <h1 class="titulo" style="margin-right: 90px;">Formulario</h1>
        <a href="http://www.ips.edu.ar" target="_blank"><img src="assets/polinegativo.jpg" alt="Politécnico"
                class="logopoli"></a>
    </header>
    <?php if(!$_SESSION['bloq']): ?>

    <div class="todo">
        <!-- FORMULARIO -->
        <form id="user-form">
            <div>
                <input type="hidden" id="taskId" value="">
                <input type="text" id="taskTitle" placeholder="Titulo">
                <textarea name="description" id="taskDesc" cols="30" rows="15" placeholder="Descripcion"></textarea>
                <button type="submit">Guardar datos</button>
            </div>
        </form>

        <div class="todo-tabla">
            <!-- BUSCAR -->
            <div class="buscar">
                <input id="search" type="search" placeholder="Buscar tu tarea">
            </div>

            <!-- TABLA -->
            <table class="tabla" style="width: 62rem; margin-top: 28px;">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="all-tasks"></tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
    <div class="login-page" style="margin-top: -70px;">
        <div class="form">
            <img src="assets/lock.png" alt="img bloqueo" style="width: 140px;">
            <h1>Has sido bloqueado</h1>
            <h3>Motivo:
                <?= $_SESSION['bloq_text']; ?>
            </h3>
            <p style="font-size: small;">Comunicate con un administrador para poder acceder al sitio</p>
        </div>
    </div>
    <?php endif; ?>
</body>

</html>

