<?php
session_start();

session_unset();

session_destroy();

header('Location: http://200.3.127.46:8002/~uno/html/log.php');
exit();
?>