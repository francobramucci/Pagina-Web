<?php
include 'connect.php';

$id = $_POST['id'];
$bloq_text = $_POST['bloq_text'];

if (isset($id)) {
    $query2 = "SELECT bloq FROM accounts WHERE id = '$id'";
    $result2 = $mysqli->query($query2);
    
    if (!$result2) {
        die('Query Error: ' . $mysqli->error);
    }
    
    $row = $result2->fetch_assoc();
    $bloq = $row['bloq'];
    
    if ($bloq) {
        $query = "UPDATE accounts SET bloq = 0, bloq_text = '' WHERE id = '$id'";
    } else {
        if (!empty($bloq_text)) {
            $query = "UPDATE accounts SET bloq = 1, bloq_text = '$bloq_text' WHERE id = '$id'";
        } else {
            $query = "UPDATE accounts SET bloq = 1, bloq_text = 'No se proporciono motivo' WHERE id = '$id'";
        }
    }
    
    $result = $mysqli->query($query);

    if (!$result) {
        die('Query Error: ' . $mysqli->error);
    }
}
?>