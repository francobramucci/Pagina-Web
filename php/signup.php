<?php

    include 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $date = date("d-m-Y H:i:s");
    echo "no entra";
    if(isset($email) && isset($password)){
        $email = $mysqli->real_escape_string($email);
        $password_hash = $mysqli->real_escape_string($password_hash);
        $date = $mysqli->real_escape_string($date);

        if(!empty($email) && !empty($password_hash)){
            $query = "INSERT into accounts(email,pass,sign_date,cant_log,admins,bloq) VALUES('$email','$password_hash','$date',0,0,0)";
            $result = $mysqli->query($query);

            if(!$result){
                die('Query Error' . $mysqli->connect_error);
            }
            echo "Account Added Succesfully";
        }
    }
?>