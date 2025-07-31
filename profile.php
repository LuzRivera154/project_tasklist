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
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $verPerfil = verPerfil($id);
}

if (isset($_GET['eliminar_perfil'])) {
    $id = $_SESSION['id'];
    $eliminartareas = borrarTodasLasTareas($id);
    $eliminar = deleteByIdPerfil($id);
    session_destroy();
    header("Location: index.php");
}
if (isset($_POST['cambiar'])) {
    $id = $_SESSION['id'];
    $password = $_POST['password'];
    $cambiar = updatepassword($id, $password);
    echo "<script>alert('Se guardo tu contraseña');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/82497b746b.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleforprofile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tagesschrift&display=swap" rel="stylesheet">

    <title>Perfil</title>
</head>

<body>
        <div class="idioma">
        <ul class="ul-idioma">
            <li class="opcion">Idioma
                <ul class="ul-container">
                    <li class="lista-idioma"><a href="profile.php">Español</a></li>
                    <li class="lista-idioma"><a href="profile-fr.php">Frances</a></li>
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
                    <a href="exit.php" name="exit">Exit
                        <i class="fa-solid fa-right-from-bracket exit"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <section class="ver-informacion">
            <i class="fa-solid fa-circle-user icono-user"></i>
            <div>
                <h2 class="titulo-informacion">Informaciones</h2>
                <ul class="lista">
                    <?php foreach ($verPerfil as $perfil) : ?>
                        <li>Nombre: <?= $perfil['Nombre']; ?> </li>
                        <li>Usuario: <?= $perfil['User']; ?> </li>
                        <li>Email: <?= $perfil['Email']; ?> </li>
                        <li>Genero: <?= $perfil['Genero']; ?> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <section class="eliminar-perfil">
            <form action="" method="get" class="form-eliminar" >
                <input type="submit" name="cambiar_contraseña" id="btn-form" class="btn-form"   value="Cambiar contraseña">
            </form>
            <form action="" method="get" class="form-eliminar" onsubmit="return confirmarEliminacion()">
                <input type="submit" name="eliminar_perfil" id="eliminar_perfil" class="btn-form" value="Eliminar perfil">
            </form>
        </section>
        <section class="section-escondida" id="escondida">
            <p>Cambiar contraseña</p>
            <form action="" method="post" onsubmit="return confirmarCambio()">
                <label for="password">Nueva contraseña (minimo 8 caracteres): </label>
                <input type="password" name="password" id="password" class="password" minlength="8" required >
                <input type="submit" value="Cambiar" class="cambiar" name="cambiar" >
            </form>
        </section>
    </div>

</body>

<script>
    function confirmarEliminacion() {
        return confirm("Estas seguro que queres borrar tu perfil?");
    }

    function confirmarCambio() {
        return confirm("Estas seguro que queres cambiar tu contraseña?");
    }
    document.getElementById('btn-form').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('escondida').style.display = 'block'
    })

    const opcion = document.querySelector('.ul-idioma .opcion');
    const menu = opcion.querySelector('.ul-container');

    let abierto = false;

    opcion.addEventListener('click', () => {
        abierto = !abierto;
        menu.style.display = abierto ? 'block' : 'none';
    });
</script>

</html>