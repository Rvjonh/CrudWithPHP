<?php 

    session_start();

    require "database.php";

    $message = "";

    if(!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["telefono"]) && !empty($_POST["cedula"])  && !empty($_POST["correo"]) && !empty($_POST["contrasena"])){

        $sql = "UPDATE users SET nombre=:nombre, apellido=:apellido, cedula=:cedula, telefono=:telefono, correo=:correo, contrasena=:contrasena WHERE id=:id ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['user_id']);

        $stmt->bindParam(':nombre', $_POST["nombre"]);
        $stmt->bindParam(':apellido', $_POST["apellido"]);
        $stmt->bindParam(':cedula', $_POST["cedula"]);
        $stmt->bindParam(':telefono', $_POST["telefono"]);
        $stmt->bindParam(':correo', $_POST["correo"]);
        $stmt->bindParam(':contrasena', $_POST["contrasena"]);


        if($stmt->execute()){
            $message = "Cambio de datos completado";
            header('Location: index.php');
        }else{
            $message = "No se cambiaron los datos correctamente";
            echo 'PARECE QUE HUBO UN ERROR! ';
        }
        
    }
    

?>