<?php

include 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$date = date("d-m-Y H:i:s");

if (!empty($email) && !empty($password)) {
    $email = $mysqli->real_escape_string($email);
    $date = $mysqli->real_escape_string($date);
            
    // Verificar si el usuario ya existe en la base de datos
    $query = "SELECT id FROM accounts WHERE email = '$email'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $registro = false;
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $password_hash = $mysqli->real_escape_string($password_hash);

        $query = "INSERT INTO accounts (email, pass, sign_date, last_log, cant_log, admins, bloq, bloq_text)
                  VALUES ('$email', '$password_hash', '$date', '', 0, 0, 0, '')";
        $result = $mysqli->query($query);

        if (!$result) {
            die('Query Error' . $mysqli->connect_error);
        }

        $registro = true;
    }
}

if($registro){
    $response = array(
        'success' => true,
        'message' => ''
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'El correo electrónico ya está registrado. Intente con otro.'
    );
}

$jsonstring = json_encode($response);
header('Content-Type: application/json');
echo $jsonstring;
?>
