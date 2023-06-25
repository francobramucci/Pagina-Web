<?php
    session_start();

    if(isset($_SESSION['user_id'])){
        header("Location: http://200.3.127.46:8002/~uno/html/formulario.php");
        die();
    }

    if (!isset($_SESSION['tiempo'])) {
        $_SESSION['tiempo']=time();
    }
    else if (time() - $_SESSION['tiempo'] > 120) {
        session_destroy();
        header("Location: http://200.3.127.46:8002/~uno/html/sign.php");
        die();  
    }
    $_SESSION['tiempo']=time();
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="signup.js"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header> 
            <div class="guia">
                <a href="formulario.php">Formulario</a>
                <a href="../index.html">Integrantes</a>
            </div>
        </header>
        <form id="signup">
            <input type="email" id="signEmail" placeholder="E-mail">
            <input type="password" id="password" placeholder="Password">
            <button type="submit">Registrarse</button>
        </form>
        <a href="log.php">Ya tiene una cuenta? Inicie sesion</a>
    </body>
</html>