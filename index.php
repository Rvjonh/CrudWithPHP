<?php 
    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: inicio.php');
    }

    require "database.php";

  
    if (!empty($_POST['correo']) && !empty($_POST['contrasena'])) {
        $records = $conn->prepare('SELECT id, nombre, apellido, cedula, telefono, correo, contrasena FROM users WHERE correo = :correo');
        $records->bindParam(':correo', $_POST['correo']);

        
        if($records->execute()){ 
            $results = $records->fetch(PDO::FETCH_ASSOC);
    
            $message = '';
            if (!empty($results)) {
        
                if (strcmp($_POST["contrasena"],$results["contrasena"])==0) {
                    $_SESSION['user_id'] = $results['id'];
                    header("Location: inicio.php");
                } else {
                    $message = 'Lo siento, usuario o contraseña no valida';
                }
            }else {
                $message = 'Lo siento, usuario o contraseña no valida';
            }
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publiship</title>
    <link rel="shortcut icon" href="imagenes\logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets\css\estilos.css">
    <link rel="stylesheet" href="assets\css\estilosIndex.css">
</head>
<body>
    <header>
        <a class="inicio" href="index.php">
            <img class="logo" src="imagenes\logo.png" alt="Pucliship">
            <h1>Publiship</h1>
        </a>
        
        <div class="botones">
            <a class="botonInicio" href="index.php">Iniciar Sesion</a>
            <a class="botonInicio" href="signup.php">Registrarse</a>
        </div>
    </header>
    <main>
        <section class="bienvenida">
            <div class="presentacion">
                <img class="logo" src="imagenes\logo.png">
                <h2>Inicia sesion</h2>
                <p>Checa los nuevos articulos publicados</p>
            </div>
            <div class="formInicio">
                <form class="formulario" action="index.php" method="post">
                    <h2>Formulacio de inicio</h2>  

                    <?php if(!empty($message)): ?>
                        <p class="mensaje" ><?= $message ?></p>
                    <?php endif; ?>
                   
                    <input name="correo" type="email" placeholder="Correo electronico">
                    <input name="contrasena" type="password" placeholder="Contraseña">
                    <button type="submit">Iniciar sesion</button>
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