<?
include 'connect.php';

$id = $_POST['id'];

if(isset($id)){
    $query2 = "SELECT admins FROM accounts WHERE id = '$id'";
    $result2 = $mysqli->query($query2);
    if($result2['admins']){
        $reverse = 0;
    } else {
        $reverse = 1;
    }

    $query = "UPDATE accounts SET admins='$reverse' WHERE id = '$id'";
    $result = $mysqli->query($query);

    if(!$result || !$result2){
        die('Query Error' . $mysqli->error);
    }
}
?>