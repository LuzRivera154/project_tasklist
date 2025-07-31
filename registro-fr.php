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
            echo "<script>alert('Inscription réussie');</script>";
            header('Location: index-fr.php');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // código de error SQL para violación de restricción (como UNIQUE)
                if (str_contains($e->getMessage(), 'User')) {
                    echo "<script>alert('Le nom d'utilisateur ou l'e-mail est déjà utilisé');</script>";
                } else {
                    echo "<script>alert('Le champ genre est obligatoire');</script>";
                }
            } else {
                echo "<script>alert('Erreur lors de l'inscription: " . $e->getMessage() . "');</script>";
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
            <li class="opcion">Langue
                <ul class="ul-container">
                    <li class="lista-idioma"><a href="registro.php">Español</a></li>
                    <li class="lista-idioma"><a href="registro-fr.php">Frances</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="container">
        <form action="" method="POST">
            <h2>M'inscrire</h2>
            <label for="user">Prénom:</label>
            <input type="text" name="name" id="name" required>
            <label for="user">Nom d'utilisateur:</label>
            <input type="text" name="user" id="user" required>
            <label for="genero" id="genero">Genre:</label>
            <select name="genero" class="genero-select" required> 
            <option value="principal" disabled selected hidden>Choisissez une option</option>
            <option value="Femenino">Femme</option>
            <option value="Masculino">Homme</option>
            </select>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password"> Mot de passe (minimum 8 caractères) :</label>
            <input type="password" name="password" id="password" minlength="8" required>
            <input type="submit" class="boton" name="Registrar" value="S'inscrire">
            <div class="btn-container">
                <p>Vous avez déjà un compte?</p>
                <a href="index-fr.php">Se connecter</a>
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