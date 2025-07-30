<?php
session_start();

require_once 'crud-for-tasklist.php';
require_once 'inicio.php';
if (isset($_GET['id'])) {
    $db = conection();
    $id = $_GET['id'];
    $eliminar = $bdd -> prepare("delete from UserForTasklist where id = ?;");
    $eliminar -> execute([$id]);
    header("location:inicio.php");
} else
echo 'errorrrr';

