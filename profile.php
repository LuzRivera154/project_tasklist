<?php
session_start();


require_once 'crud-for-tasklist.php';
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
    $tareas = getById($id_user);
}
if (isset($_GET['eliminar_perfil'])) {
    $id = $_GET['eliminar_perfil'];
    $eliminar = deleteByIdPerfil($id);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleforprofile.css">
    <title>Perfil</title>
</head>
<body>
    <div class="container">
        <nav class="container-exit">
            <ul>
                <li><a href="profile.php">Perfil
                    <i class="fa-solid fa-circle-user"></i>
                </a></li>
                <li><a href="#agregar-tarea">Agregar Tarea
                    <i class="fa-solid fa-pen-to-square"></i>
                </a></li>
                <li>
                    <a href="exit.php" name="exit">Exit
                        <i class="fa-solid fa-right-from-bracket exit"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <section class="ver-informacion">
        <i class="fa-solid fa-circle-user"></i>
        <ul>
            <li>
                
            </li>
        </ul>
    </section>
    <section class="eliminar-perfil">
        <form action="" method="get">
            <label for="eliminar_perfil">Queres eliminar tu perfil?
            <input type="submit" name="eliminar_perfil" value="Eliminar perfil"> 
            </label>
        </form>
        <a href="inicio.php">Volver</a>
    </section>
</body>
</html>