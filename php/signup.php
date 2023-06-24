<?php

    include 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $date = date("d-m-Y H:i:s");

    if(isset($email) && isset($pass)){
        $email = $users->real_escape_string($email);
        $password_hash = $users->real_escape_string($password_hash);
        $date = $users->real_escape_string($date);

        if(!empty($email) && !empty($password_hash)){
            $query = "INSERT into accounts(email,pass,sign_date,cant_log,admins,bloq) VALUES('$email','$password_hash','$date',0,0,0)";
            $result = $users->query($query);

            if(!$result){
                die('Query Error' . $users->connect_error);
            }
            //echo "User Added Succesfully";
        }
    }
?>