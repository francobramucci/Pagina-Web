<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: http://200.3.127.46:8002/~uno/html/formulario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="signup.js"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href = "estilos.css">
    </head>
    <body>
        <div class="login-page">
            <div class="form">
                <form id="signup" class="login-form">
                    <input type="text" id="signEmail" placeholder="Email"/>
                    <input type="password" id="password" placeholder="Password"/>
                    <button>Registrarse</button>
                    <p class="message">Ya tiene una cuenta? <a href="log.php">Inicie sesion</a></p>
                    <p id="response"></p>
                </form>
            </div>
        </div>
    </body>
</html>