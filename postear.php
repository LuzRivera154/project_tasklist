<?php
session_start();
require_once "crud-for-tasklist.php";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
if (isset($_POST['Publicar'])) {
    $id_user=$_SESSION['id'];
    $titulo = $_POST['titulo-post'];
    $contenido = $_POST['contenido-post'];
    $fecha = date("Y-m-d H:i:s");
        if (insertPost($id_user, $titulo, $contenido, $fecha)) {
        echo 'POST SUBIDO';
    } else {
        echo 'error';
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styleforpostear.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tagesschrift&display=swap" rel="stylesheet">
    <title>Subir Post</title>
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
        <nav class="container-nav">
            <ul>
                <li><a href="inicio.php">Inicio
                        <i class="fa-solid fa-house icono-inicio"></i>
                    </a></li>
                     <li><a href="profile.php">Perfil
                        <i class="fa-solid fa-circle-user icono-inicio"></i>
                    </a></li>
                <li><a href="inicio.php">Agregar Tarea
                        <i class="fa-solid fa-pen-to-square icono_agregar"></i>
                    </a></li>
                <li>
                    <a href="blog.php">Blog
                        <i class="fa-solid fa-newspaper icono-blog"></i>
                    </a>
                </li>
                <li>
                    <a href="exit.php" name="exit">Exit
                        <i class="fa-solid fa-right-from-bracket exit"></i>
                    </a>
                </li>
            </ul>
        </nav>
            <section class="publicar-post">
                <div class="container-publicar">
            <form action="" method="post">
                <label for="titulo-post">Titulo:</label>
                <input type="text" name="titulo-post" id="titulo-post" placeholder="Titulo del post" required>
                <label for="contenido-post">Contenido:</label>
                <textarea rows="4" cols="50" maxlength="255" name="contenido-post" id="contenido" placeholder="Escribi aqui tu post" required></textarea>
                <input type="submit" name="Publicar" value="Publicar">
            </form>
            <a href="blog.php">volver</a>
            </div>
        </section>
    </div>
</body>
</html>