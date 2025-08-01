<?php
session_start();

require_once 'crud-for-tasklist.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Registrar'])) {
        $nombre = $_POST['name'];
        $usuario = $_POST['user'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $genero = $_POST['genero'];
        try {
            registro($nombre, $usuario, $email, $password, $genero);
            // ✅ Mensaje si todo salió bien
            echo "<script>alert('Registro exitoso');</script>";
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // código de error SQL para violación de restricción (como UNIQUE)
                if (str_contains($e->getMessage(), 'User')) {
                    echo "<script>alert('El nombre de usuario o email ya está en uso');</script>";
                } else {
                    echo "<script>alert('Falta completar el campo de genero');</script>";
                }
            } else {
                echo "<script>alert('Error al registrar: " . $e->getMessage() . "');</script>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleforregister.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tagesschrift&display=swap"
        rel="stylesheet">
    <title>Registro</title>
</head>

<body>
        <div class="idioma">
        <ul class="ul-idioma">
            <li class="opcion"> Idioma
                <ul class="ul-container">
                    <li class="lista-idioma"><a href="registro.php">Español</a></li>
                    <li class="lista-idioma"><a href="registro-fr.php">Frances</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="container">
        <form action="" method="POST">
            <h2>Registrarme</h2>
            <label for="user">Nombre:</label>
            <input type="text" name="name" id="name" required>
            <label for="user">User:</label>
            <input type="text" name="user" id="user" required>
            <label for="genero" id="genero">Genero:</label>
            <select name="genero" class="genero-select" required> 
            <option value="principal" disabled selected hidden>Elegi una opcion</option>
            <option value="Femenino">Mujer</option>
            <option value="Masculino">Hombre</option>
            </select>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password (minimo 8 caracteres):</label>
            <input type="password" name="password" id="password" minlength="8" required>
            <input type="submit" class="boton" name="Registrar" value="Registrar">
            <div class="btn-container">
                <p>Ya tenes una cuenta?</p>
                <a href="index.php">Ingresa</a>
            </div>
        </form>
    </div>
</body>
<script>
    const opcion = document.querySelector('.ul-idioma .opcion');
    const menu = opcion.querySelector('.ul-container');

    let abierto = false;

    opcion.addEventListener('click', () => {
        abierto = !abierto;
        menu.style.display = abierto ? 'block' : 'none';
    });
</script>

</html>