<?php

    include 'connect.php';

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /html/formulario.html');
    }

    $email = $_POST['email']
    $password = $_POST['password']

    if (!empty($email) && !empty($password)) {
        $query = "SELECT id, email, pass FROM accounts WHERE email = '$email'"
        $results = $users->query($query);

        if (count($results) > 0 && password_verify($password, $results['pass'])) {
            $_SESSION['user_id'] = $results['id'];
            header("Location: /html/formulario.html");
        }
    }
?>