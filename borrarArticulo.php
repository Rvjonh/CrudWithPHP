<?php

    require 'database.php';
        
    $records = $conn->prepare("DELETE FROM publicaciones WHERE id = :id");
    $records->bindParam(':id', $_POST['numero']);
    if($records->execute()){
        echo 'correcto';
        header('Location: index.php');
    }else {
        echo 'Fallo en el sistema de base de datos';
    }
?>