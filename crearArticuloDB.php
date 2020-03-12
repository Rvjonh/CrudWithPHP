<?php
    require 'database.php';

    if(!empty($_POST["titulo"]) && !empty($_POST["contenido"])){
        $sql = "INSERT INTO publicaciones (titulo, descripcion) VALUES (:titulo, :descripcion)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(":titulo",$_POST["titulo"]);
        $stmt->bindParam(":descripcion",$_POST["contenido"]);

        if($stmt->execute()){
            echo "Registro de nuevo usuario completado!";
        }else{
            echo "No se registro correctamente";
        }
        
    }
    header('Location: index.php');

?>