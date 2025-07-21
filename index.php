<?php
session_start();
$_SESSION['username'] = 'JohnDoe';
$_SESSION['role'] = 'admin';
var_dump($_SESSION);
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
        <form action="upload.php" method="post">
            <h2>Ingresa tu usuario y contraseña</h2>
            <label for="user">User:</label>
            <input type="text" name="user" id="user" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" class="boton" value="Enviar">
            <div class="btn-container">
            <p>Todavia no te registraste?</p>          
            <a href="registro.php">Registrarme</a>
            </div>
        </form>
    </div>
</body>
</html>