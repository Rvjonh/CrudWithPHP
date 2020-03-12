<?php
    require "database.php";

    $message = "";

    if(!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["telefono"]) && !empty($_POST["cedula"])  && !empty($_POST["correo"]) && !empty($_POST["contrasena"])){
        $sql = "INSERT INTO users (nombre, apellido, cedula, telefono, correo, contrasena) VALUES (:nombre, :apellido, :cedula, :telefono, :correo, :contrasena)";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":nombre", $_POST["nombre"]);
        $stmt->bindParam(":apellido", $_POST["apellido"]);
        $stmt->bindParam(":cedula", $_POST["cedula"]);
        $stmt->bindParam(":telefono", $_POST["telefono"]);
        $stmt->bindParam(":correo", $_POST["correo"]);
        $stmt->bindParam(":contrasena",$_POST["contrasena"]);

        if($stmt->execute()){
            $message = "Registro de nuevo usuario completado!";
        }else{
            $message = "No se registro correctamente";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="imagenes\logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets\css\estilos.css">
    <link rel="stylesheet" href="assets\css\estilosRegistro.css">
</head>
<body>
    <header>
        <a class="inicio" href="index.php">
            <img class="logo" src="imagenes\logo.png" alt="Pucliship">
            <h1>Publiship</h1>
        </a>
        <div class="botones">
            <a class="botonInicio" href="index.php">Iniciar Sesion</a>
            <a class="botonInicio" href="">Registrarse</a>
        </div>
    </header>
    <main>
        <section class="bienvenida">
            <div class="presentacion">
                <img class="logo" src="imagenes\logo.png">
                <h2>Registro nuevo</h2>
                <p>Registrate para poder iniciar sesion</p>
            </div>
            <div class="formInicio">
                <form class="formulario" action="signup.php" method="post">
                    <h2>Formulacio de registro</h2>  

                    <?php if(!empty($message)): ?>
                        <p><?= $message ?></p>
                    <?php endif; ?>

                    <input name="nombre" required type="text" placeholder="Nombre" maxlength="50">
                    <input name="apellido" required type="text" placeholder="Apellido" maxlength="50">
                    <input name="cedula" required type="cel" title="Debe ingresar solo numeros, sin signos" placeholder="Cedula" maxlength="9" title="Sin caracteres especiales, ni puntos">
                    <input name="telefono" required type="cel" placeholder="Telefono" maxlength="11" title="Numeros no largos">
                    <input name="correo" required type="email" placeholder="Correo electronico">
                    <input name="contrasena" required type="password" placeholder="Contraseña" maxlength="20" title="No mas de 20 caracteres">
                    <button type="submit">Registrar</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>Proyecto CRUD(php) por Gomez Jonh</p>
        <p>&copy and &reg</p>
    </footer>
</body>
</html>