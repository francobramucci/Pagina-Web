<?php

    include 'connect.php';

    session_start();

    /*
    if (isset($_SESSION['user_id'])) {
        header('Location: /html/formulario.html');
    }*/

    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = date("d-m-Y H:i:s");

    if (!empty($email) && !empty($password)) {
        $query = "SELECT id, cant_log, admins, bloq, bloq_text FROM accounts WHERE email = '$email'";
        $results = $users->query($query);

        $new_log = $results['cant_log']+1;
        $query2 = "INSERT into accounts(last_log,cant_log) VALUES ('$date', '$new_log')";
        $results2 = $users->query($query2);

        if(!$results2){
            die('Query Error' . $users->connect_error);
        }

        if (count($results) > 0 && password_verify($password, $results['pass'])) {
            $_SESSION['user_id'] = $results['id'];
            $_SESSION['admins'] = $results['admins'];
            $_SESSION['bloq'] = $results['bloq'];
            $_SESSION['bloq_text'] = $results['bloq_text'];
            //header("Location: /html/formulario.html");
        }
    }
?>