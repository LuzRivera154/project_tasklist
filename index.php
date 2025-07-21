<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ingreso</title>
</head>
<body>
    <div class="container">
        <form action="upload.php" method="post">
            <label for="user"> User </label>
            <input type="text" name="user" id="user" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Enviar">          
                <a href="registro.php">Registarme</a>
        </form>
    </div>
</body>
</html>