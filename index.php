<?php
session_start();

require_once 'crud-for-tasklist.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //RECIBO INFORMACION
    if (isset($_POST['Ingresar'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];
        $usuarioValidado = verificarUsuario($user, $password);

        //USUARIO VALIDADO SI ES TRUE ENTONCES VOY INICIO
        if ($usuarioValidado) {
            $_SESSION['username'] = $usuarioValidado['User'];
            $_SESSION['id'] = $usuarioValidado['id'];
            header('Location: inicio.php');
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tagesschrift&display=swap" rel="stylesheet">
    <title>Ingreso</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <h2>Ingresa tu usuario y contraseña</h2>
            <label for="user">User:</label>
            <input type="text" name="user" id="user" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password"  required>
            <input type="submit" class="boton" name="Ingresar" value="Ingresar">
            <div class="btn-container">
                <p>Todavia no te registraste?</p>
                <a href="registro.php">Registrarme</a>
            </div>
        </form>
    </div>
</body>

</html>