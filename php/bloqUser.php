<?
include 'connect.php';

$id = $_POST['id'];
$bloq_text = $_POST['bloq_text'];

if(isset($id)){
    $query2 = "SELECT bloq FROM accounts WHERE id = '$id'";
    $result2 = $mysqli->query($query2);
    if($result2['bloq']){
        $reverse = 0;
    } else {
        $reverse = 1;
    }

    $query = "UPDATE accounts SET bloq='$reverse',bloq_text='$bloq_text' WHERE id = '$id'";
    $result = $mysqli->query($query);

    if(!$result || !$result2){
        die('Query Error' . $mysqli->error);
    }
}
?>