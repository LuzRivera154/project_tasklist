<?php
session_start();


require_once 'crud-for-tasklist.php';
$mensaje_fem = "Bienvenida ";
$mensaje_masc = "Bienvenido ";

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
    $tareas = getById($id_user);
    $genero = recuperarGenero($id_user);
}

if (isset($_POST['completar_id'])) {
    $idTarea = $_POST['completar_id'];
    updatetarea($idTarea);
    header("Location: inicio.php");
}
if (isset($_POST['agregar'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tiempo = $_POST['tiempo'];
    $id_user = $_SESSION['id'];
    AgregarTarea($id_user, $titulo, $descripcion, $tiempo);
    header("Location: inicio.php");
}

if (isset($_GET['eliminar_id'])) {
    $id = $_GET['eliminar_id'];
    $eliminar = deleteById($id);
    header("Location: inicio.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            <li class="opcion">Idioma
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
                <li><a href="profile.php">Perfil
                        <i class="fa-solid fa-circle-user icono-inicio"></i>
                    </a></li>
                <li><a href="#agregar-tarea">Agregar Tarea
                        <i class="fa-solid fa-pen-to-square icono-agregar"></i>
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

        </form>
        <section class="container-bienvenida">
            <?php if ($genero[0]['Genero'] == "Femenino"): ?>
                <h1 class="titulo"><?= $mensaje_fem ?> <?= $_SESSION['username'] ?></h1>
            <?php elseif ($genero[0]['Genero'] == "Masculino"): ?>
                <h1 class="titulo"><?= $mensaje_masc ?> <?= $_SESSION['username'] ?></h1>
            <?php endif; ?>
            <p class="parrafo-container-bienvenida">Tareas pendientes</p>
        </section>
        <section class="container-tabla">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Tiempo</th>
                        <th>Estado</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                    <?php foreach ($tareas as $tarea): ?>
                        <?php if ($tarea['estado'] !== 'completada'): ?>
                            <tr>
                                <td><?= $tarea['tarea'] ?></td>
                                <td><?= $tarea['descripcion'] ?></td>
                                <td><?= $tarea['tiempo'] ?> Minutos</td>
                                <td>
                                    <?php if ($tarea['estado'] !== 'completada'): ?>
                                        <form method="post" action="inicio.php">
                                            <input type="hidden" name="completar_id" value="<?= $tarea['id'] ?>">
                                            <button type="submit" class="completar" name="completar">✔ Completar</button>
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

        <h2 class="tareas-completadas">Tareas completadas</h2>
        <section class="container-tabla">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Tiempo</th>
                        <th>Estado</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                    <?php foreach ($tareas as $tarea): ?>
                        <?php if ($tarea['estado'] == 'completada'): ?>
                            <tr>
                                <td><?= $tarea['tarea'] ?></td>
                                <td><?= $tarea['descripcion'] ?></td>
                                <td><?= $tarea['tiempo'] ?> Minutos</td>
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
            <p class="parrafo-tarea">Agregar tarea</p>
            <form action="" method="post" class="form-ingresar">
                <label for="titulo">Titulo:
                    <input type="text" name="titulo" required>
                </label>
                <label for="descripcion">Descripción:
                    <input type="text" name="descripcion" class="input-grande">
                </label>
                <label for="tiempo">Tiempo (minutos):
                    <input type="number" min="1" step="1" name="tiempo">
                </label>
                <input type="submit" name="agregar" id="btn-agregar" value="Agregar">
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