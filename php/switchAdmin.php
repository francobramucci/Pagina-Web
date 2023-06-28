<?php

include 'connect.php';

$id = $_POST['id'];

if (isset($id)) {
    $query = "SELECT admins FROM accounts WHERE id = '$id'";
    $result = $mysqli->query($query);
    
    if (!$result) {
        die('Query Error: ' . $mysqli->error);
    }
    
    $row = $result->fetch_assoc();
    $admins = $row['admins'];
    
    if ($admins) {
        $reverse = 0;
    } else {
        $reverse = 1;
    }

    $query = "UPDATE accounts SET admins = '$reverse' WHERE id = '$id'";
    $result = $mysqli->query($query);

    if (!$result) {
        die('Query Error: ' . $mysqli->error);
    }
}
?>
