<?php
session_start();
require_once "crud-for-tasklist.php";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}

$posts = getAllPost();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="styleforblog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tagesschrift&display=swap" rel="stylesheet">

    <title>Blog</title>
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
        <a href="postear.php">Postear algo</a>
        <section class="mostrar-post">
            <!-- Mostrar post -->
            <div class="container-post">
                <?php foreach ($posts as $post): ?>
                    <div class="post-unico">
                        <!-- HEADER post -->
                        
                            <?php if (!is_null($post['Foto'])): ?>
                                <img class="avatar" src="<?= $post['Foto'] ?>" alt="avatar">
                            <?php else : ?>
                                <i class="fa-solid fa-circle-user icono-avatar"></i>
                            <?php endif; ?>
                        
                        <!-- contenido post -->
                        <div class="contenido-post">
                            <div class="texto-post">
                                <h3 class="user-post"><?= $post['User'] ?> </h3>
                                <p> <span>id_user:</span> <?= $post['id_user'] ?> </p>
                            </div>
                            <h3 class="titulo-post"> <?= $post['Titulo'] ?> </h3>
                            <div class="contenido">
                                <?= $post['Contenido'] ?>
                            </div>
                            <p class="datetime-p"><?= $post['Fecha'] ?> </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


</body>

</html>