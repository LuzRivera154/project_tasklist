<?php
session_start();
var_dump($_SESSION)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleforregister.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>/
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tagesschrift&display=swap" rel="stylesheet">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <form action="upload.php" method="post">
            <h2>Registrarme</h2>
            <label for="user">Nombre:</label>
            <input type="text" name="name" id="name" required>
            <label for="user">User:</label>
            <input type="text" name="user" id="user" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" class="boton" value="Registrar">
            <div class="btn-container">
            <p>Ya tenes una cuenta?</p>          
            <a href="index.php">Ingresa</a>
            </div>
        </form>
    </div>
</body>
</html>