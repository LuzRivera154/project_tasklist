<?php
session_start();

 if($user == $_POST['user'] && $password == $_POST['password']){
    session_start();
    $_SESSION['user'] = $user;
   }

$host = "localhost";      // Generalmente localhost si la BD está en tu PC o servidor
$dbname = "app-database";    // Nombre exacto de la base que creaste en Adminer
$user = "root";     // Usuario de la BD (ej: root)
$password = "root"; // Contraseña del usuario de la BD

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Para mostrar errores (opcional pero recomendado)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
//Verifico si tocaron el boton registar
if (isset($_POST["Registrar"])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
}






?>

