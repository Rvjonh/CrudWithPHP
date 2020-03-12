<?php 
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, nombre, apellido, cedula, telefono, correo, contrasena FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
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
    <link rel="stylesheet" href="assets\css\estilosInicio.css">
    <script src="assets\javascript\funciones.js"></script>
</head>
<body>
    <header>
        <a class="inicio" href="inicio.php">
            <img class="logo" src="imagenes\logo.png" alt="Pucliship">
            <h1>Publiship</h1>
        </a>
        
        <div class="botones">
            <?php if(!empty($user)): ?>
                <a class="botonInicio" href="inicio.php">Inicio</a>
                <a class="botonInicio" href="logout.php">Cerrar sesion</a>
            <?php else: ?>
                <a class="botonInicio" href="index.php">Iniciar Sesion</a>
                <a class="botonInicio" href="signup.php">Registrarse</a>
            <?php endif; ?>
        </div>
    </header>
    <div class="tituloInicio">
        <h2>Bienvenido a Publiship</h2>
    </div>
    <main>
        
        <?php if(!empty($user)): ?>
            <section class="perfil">
                <picture class="centrado">
                    <img class="imagenPerfil" src="imagenes\user.png" alt="">
                </picture>
                <p>Nombre: <?= $user['nombre']; ?></p>
                <p>Apellido: <?= $user['apellido']; ?></p>
                <p>Cedula: <?= $user['cedula']; ?></p>
                <p>Telefono: <?= $user['telefono']; ?></p>
                <p>Correo: <?= $user['correo']; ?></p>
                <p class="centrado"><span class="punto">&#128516</span> Usuario activo</p>

                <p id="editar" class="buttonEditar">EDITAR CUENTA</p>
                <form id="cambiarDatos" action="cambiarDatosDB.php" method="POST">
                    <h2>Editar datos de cuenta</h2>
                    <input name="nombre" required type="text" placeholder="Nombre" maxlength="50">
                    <input name="apellido" required type="text" placeholder="Apellido" maxlength="50">
                    <input name="cedula" required type="cel" title="Debe ingresar solo numeros, sin signos" placeholder="Cedula" maxlength="9" title="Sin caracteres especiales, ni puntos">
                    <input name="telefono" required type="cel" placeholder="Telefono" maxlength="11" title="Numeros no largos">
                    <input name="correo" required type="email" placeholder="Correo electronico">
                    <input name="contrasena" required type="password" placeholder="Contraseña" maxlength="20" title="No mas de 20 caracteres">
                    <br><button type="submit" class="ButtonEnviarEditar">EDITAR</button>
                    <p id="CerrarEditar" class="buttonCancelarEditar">CANCELAR</p>
                </form>
                
                <form action="deleteAcount.php" method="POST">
                    <p id="aparecer">ELIMINAR CUENTA</p>
                    <div id="bloqueDeConfirmacion" class="bloqueDeConfirmacion">
                        <h2 style="color: red;">Alerta</h2>
                        <p>
                            ¿Desea eliminar la cuenta?
                        </p>
                        <button class="buttonAlert">Aceptar</button>
                        <p id="CerrarBloque" class="buttonCancelar">Cancelar</p>
                    </div>
                </form>
            </section>
            <section class="articulos">
                <form id="creadorArticulos" class="creadorArticulos" action="crearArticuloDB.php" method="POST">
                    <h3>Crea una publicacion</h3>
                    <input name="titulo" type="text" placeholder="Ingresa un titulo">
                    <br>
                    <textarea name="contenido" cols="10" rows="5" placeholder="Escribe el mensaje aqui..."></textarea>
                    <br>
                    <button name="publicar" type="submit">Publicar</button>
                </form>

                <?php 
                    require 'cargarArticulos.php';
                ?>
                


            </section>

        <?php else: ?>
            <div class="NoIniciado">
                <h1>Por favor, Inicia sesion o Registrate</h1>
                <a href="index.php">Iniciar sesion</a> or <br>
                <a href="signup.php">Registrarse</a> <br>
            </div>
        <?php endif; ?>
    </main>

    <footer>
    <p>Proyecto CRUD(php) por Gomez Jonh</p>
        <p>&copy and &reg</p>
    </footer>
</body>
</html>