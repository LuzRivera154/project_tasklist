<?php
session_start();


require_once 'crud-for-tasklist.php';
if (!isset($_SESSION['id'])) {
    header("Location: index-fr.php");
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
    header("Location: index-fr.php");
}
if (isset($_POST['cambiar'])) {
    $id = $_SESSION['id'];
    $password = $_POST['password'];
    $cambiar = updatepassword($id, $password);
    echo "<script>alert('Votre mot de passe a été enregistré');</script>";
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

    <title>Profil</title>
</head>

<body>
    <div class="container">
        <nav class="container-nav">
            <ul>
                <li><a href="inicio-fr.php">Accueil
                        <i class="fa-solid fa-circle-user icono-inicio"></i>
                    </a></li>
                <li><a href="inicio-fr.php">Ajouter une tâche
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
                <h2 class="titulo-informacion">Informations</h2>
                <ul class="lista">
                    <?php foreach ($verPerfil as $perfil) : ?>
                        <li>Prenom: <?= $perfil['Nombre']; ?> </li>
                        <li>Utilisateur: <?= $perfil['User']; ?> </li>
                        <li>Email: <?= $perfil['Email']; ?> </li>
                        <li>Genre: <?= $perfil['Genero']; ?> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <section class="eliminar-perfil">
            <form action="" method="post" class="form-eliminar">
                <input type="submit" name="cambiar_contraseña" id="btn-form" class="btn-form" onsubmit="return confirmarCambio()" value="Changer le mot de passe">
            </form>
            <form action="" method="get" class="form-eliminar" >
                <input type="submit" name="eliminar_perfil" id="eliminar_perfil" class="btn-form" value="Supprimer le profil">
            </form>
        </section>
        <section class="section-escondida" id="escondida">
            <p>Changer le mot de passe</p>
            <form action="" method="post" onsubmit="return confirmarCambio()">
                <label for="password">Nouveau mot de passe (minimum 8 caractères): </label>
                <input type="password" name="password" id="password" class="password" minlength="8">
                <input type="submit" value="Changer" class="cambiar" name="cambiar">
            </form>
        </section>
    </div>

</body>

<script>
    function confirmarEliminacion() {
        return confirm("Êtes-vous sûr de vouloir supprimer votre profil ?");
    }

    function confirmarCambio() {
        return confirm("Êtes-vous sûr de vouloir changer votre mot de passe ?");
    }
    document.getElementById('btn-form').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('escondida').style.display = 'block'
    })
</script>

</html>