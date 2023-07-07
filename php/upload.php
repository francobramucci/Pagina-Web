<?php

include 'connect.php';

$targetDir = "/home/uno/public_html/html/assets/usuarios/";

$fileName = basename($_FILES["image"]["name"]);
$targetFile = $targetDir . $fileName;
$fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
$targetId = $targetDir . $_SESSION['user_id'] . "." . $fileType;

$allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
if (in_array($fileType, $allowedTypes)) {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    $query = "UPDATE accounts SET image='$fileName' WHERE id='" . $_SESSION['user_id'] . "'";
    $result = $mysqli->query($query);

    if ($result) {
      echo "La imagen se ha subido y asociado correctamente al usuario.";
    } else {
      echo "Error al guardar la imagen en la base de datos.";
    }
  } else {
    echo "Error al subir la imagen.";
  }
} else {
  echo "El archivo seleccionado no es una imagen válida.";
}
?>


<?php
include "connect.php";

$target_dir = "/home/uno/public_html/html/assets/usuarios/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$target_id = $target_dir . "." . $imageFileType;

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = true;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = false;
    }
}

if ($_FILES["file"]["size"] > 700000) {
    echo "La foto debe pesar menos de 700kb";
    $uploadOk = false;
}

$allowedExtensions = ["jpg", "png", "jpeg", "gif"];
if (!in_array($imageFileType, $allowedExtensions)) {
    echo "La foto debe ser .jpg, .png, .jpeg o .gif";
    $uploadOk = false;
}

if ($uploadOk) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $query = "UPDATE users SET picture = '$target_file' WHERE id = $_SESSION['user_id']";
        $result = $mysqli->query($query);
        
        if ($result) {
            $_SESSION["picture"] = $target_file;
            echo "La foto de perfil se ha subido exitosamente";
        } else {
            echo "Error en la actualización de la base de datos: " . $mysqli->error;
        }
    } else {
        echo "Hubo un error subiendo la foto";
    }
}
?>