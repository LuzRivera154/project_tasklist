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
if (isset($_POST['completar_id'])) {
    $idTarea = $_POST['completar_id'];
    updatetarea($idTarea);
    header("Location: inicio-fr.php");
}
if (isset($_POST['agregar'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tiempo = $_POST['tiempo'];
    $id_user = $_SESSION['id'];
    AgregarTarea($id_user, $titulo, $descripcion, $tiempo);
    header("Location: inicio-fr.php");
}

if (isset($_GET['eliminar_id'])) {
    $id = $_GET['eliminar_id'];
    $eliminar = deleteById($id);
    header("Location: inicio-fr.php");
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="https://kit.fontawesome.com/82497b746b.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tagesschrift&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleforinicio.css">
    <title>Inicio</title>
</head>

<body>
    <div class="idioma">
        <ul class="ul-idioma">
            <li class="opcion">Langue
                <ul class="ul-container">
                    <li class="lista-idioma"><a href="inicio.php">Español</a></li>
                    <li class="lista-idioma"><a href="inicio-fr.php">Frances</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="container">

        <nav class="container-exit">
            <ul>
                <li><a href="profile-fr.php">Profil
                        <i class="fa-solid fa-circle-user icono-inicio"></i>
                    </a></li>
                <li><a href="#agregar-tarea">Ajouter une tâche
                        <i class="fa-solid fa-pen-to-square icono-agregar"></i>
                    </a></li>
                <li>
                    <a href="exit.php" name="exit">Exit
                        <i class="fa-solid fa-right-from-bracket exit"></i>
                    </a>
                </li>
            </ul>
        </nav>

        </form>
        <section class="container-bienvenida">
            <h1 class="titulo">Bienvenue <?= $_SESSION['username'] ?></h1>
            <p class="parrafo-container-bienvenida">Tâches en attente</p>
        </section>
        <section class="container-tabla">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Temps</th>
                        <th>État</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                    <?php foreach ($tareas as $tarea): ?>
                        <?php if ($tarea['estado'] !== 'completada'): ?>
                            <tr>
                                <td><?= $tarea['tarea'] ?></td>
                                <td><?= $tarea['descripcion'] ?></td>
                                <td><?= $tarea['tiempo'] ?> Minutes</td>
                                <td>
                                    <?php if ($tarea['estado'] !== 'completada'): ?>
                                        <form method="post" action="inicio-fr.php">
                                            <input type="hidden" name="completar_id" value="<?= $tarea['id'] ?>">
                                            <button type="submit" class="completar" name="completar">✔ Terminer</button>
                                        </form>
                                    <?php else: ?>
                                        <i class="fa-solid fa-circle-check check"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="get" action="">
                                        <input type="hidden" name="eliminar_id" value="<?= $tarea['id'] ?>">
                                        <button type="submit"><i class="fa-solid fa-circle-xmark eliminar"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- OTRA TABLA PARA MOSTRAR LO YA COMPLETADO -->

        <h2 class="tareas-completadas">Tâches terminées</h2>
        <section class="container-tabla">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Temps</th>
                        <th>État</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                    <?php foreach ($tareas as $tarea): ?>
                        <?php if ($tarea['estado'] == 'completada'): ?>
                            <tr>
                                <td><?= $tarea['tarea'] ?></td>
                                <td><?= $tarea['descripcion'] ?></td>
                                <td><?= $tarea['tiempo'] ?> Minutes</td>
                                <td>
                                    <i class="fa-solid fa-circle-check check"></i>
                                </td>
                                <td>
                                    <form method="get" action="">
                                        <input type="hidden" name="eliminar_id" value="<?= $tarea['id'] ?>">
                                        <button type="submit"><i class="fa-solid fa-circle-xmark eliminar"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <a name="agregar-tarea"></a>
        <section class="agregar-tarea">
            <p class="parrafo-tarea">Ajouter une tâche</p>
            <form action="" method="post" class="form-ingresar">
                <label for="titulo">Titre:
                    <input type="text" name="titulo" required>
                </label>
                <label for="descripcion">Description:
                    <input type="text" name="descripcion" class="input-grande">
                </label>
                <label for="tiempo">Temps (minutes):
                    <input type="number" min="1" step="1" name="tiempo">
                </label>
                <input type="submit" name="agregar" id="btn-agregar" value="Ajouter">
            </form>
        </section>
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