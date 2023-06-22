<?php

    include 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if(isset($email) && isset($pass)){
        $email = $mysqli->real_escape_string($email);
        $password_hash = $mysqli->real_escape_string($password_hash);

        if(!empty($email) && !empty($password_hash)){
            $query = "INSERT into accounts(email,pass) VALUES('$email','$password_hash')";
            $result = $users->query($query);

            if(!$result){
                die('Query Error' . $users->connect_error);
            }
            //echo "User Added Succesfully";
        }
    }
?>