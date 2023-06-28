<?php

include 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$date = date("d-m-Y H:i:s");

$email = $mysqli->real_escape_string($email);
$date = $mysqli->real_escape_string($date);

if (!empty($email) && !empty($password)) {
    $query = "SELECT id, pass, cant_log, admins, bloq, bloq_text FROM accounts WHERE email = '$email'";
    $results = $mysqli->query($query);

    if(!$results){
        die('Query Error' . $mysqli->connect_error);
    }

    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();
        if (password_verify($password, $row['pass'])) {
            $new_log = $row['cant_log'] + 1;
            $new_log = $mysqli->real_escape_string($new_log);
            $query2 = "UPDATE accounts SET last_log='$date', cant_log='$new_log' WHERE id='" . $row['id'] . "'";

            $results2 = $mysqli->query($query2);
            
            if(!$results2){
                die('Query Error' . $mysqli->connect_error);
            }

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['admins'] = $row['admins'];
            $_SESSION['bloq'] = $row['bloq'];
            $_SESSION['bloq_text'] = $row['bloq_text'];

            $inicio = true;
        }
    } else {
        $inicio = false;   
    }
}

if ($inicio) {
    $response = array(
        'success' => true,
        'message' => ''
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'El correo electronico o contraseña es invalido.'
    );
}

$jsonstring = json_encode($response);
header('Content-Type: application/json');
echo $jsonstring;

?>