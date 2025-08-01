<?php
//conexion
function conection()
{
    $host = "127.0.0.1";
    $database = "app-database";
    $user = 'root';
    $pass = 'root';
    try {
        return new PDO("mysql:host=$host;dbname=$database", $user, $pass);
    } catch (PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }
}

//agregar usuario
function registro($nombre, $usuario, $email, $password, $genero)
{
    $db = conection();
    $sql = "INSERT INTO UserForTasklist(Nombre, User, Email,Genero, Password) VALUES(:Nombre, :User, :Email,:Genero, :Password)";
    $registro = $db->prepare($sql);
    $registro->execute([
        'Nombre' => $nombre,
        'User' => $usuario,
        'Email' => $email,
        'Genero' => $genero,
        'Password' => password_hash($password, PASSWORD_BCRYPT)
    ]);
}

//Ingresar a usuario
//if los datos estan correctos y validados ingresar a pagina inicio
// sino, tiene que ingresar los datos correctos
function verificarUsuario($user, $password)
{
    $db = conection();
    $sql = "SELECT * FROM UserForTasklist WHERE `User` = :user LIMIT 1 ";
    $ingreso = $db->prepare($sql);
    $ingreso->execute(['user' => $user]);
    $usuario = $ingreso->fetch(PDO::FETCH_ASSOC);
    if ($usuario && password_verify($password, $usuario['Password'])) {
        return $usuario;
    } else {
        return false;
    }
}


// Ingresar tareas en la tabla tareas // tabla tareas tiene que mostrar las tareas especificas de cada usuario
//SELECT * FROM tareas where id_usuario = ?
function getById($id_user): array
{
    $db = conection();
    $sql = "SELECT * FROM Tasklist WHERE id_user = :id_user";
    $read = $db->prepare($sql);
    $read->execute(['id_user' => $id_user]);
    return $read->fetchAll(PDO::FETCH_ASSOC);
}


//eliminar tareas // con a link = delete.php?id=
function deleteById($id)
{
    $db = conection();
    $sql = "DELETE FROM Tasklist WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $id]);
}
// Agregar tareas
function AgregarTarea($id_user, $titulo, $descripcion, $tiempo)
{
    $db = conection();
    $sql = "INSERT INTO Tasklist(id_user, tarea , descripcion,tiempo) VALUES (:id_user, :titulo, :descripcion, :tiempo)";
    $agregar = $db->prepare($sql);
    $agregar->execute(
        [
            'id_user' => $id_user,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'tiempo' => $tiempo
        ]
    );
}

// marcar tareas ya hechas
function updatetarea($completar_id)
{
    $db = conection();
    $sql = "UPDATE Tasklist SET estado = 'completada'  WHERE id = :id ";
    $cambiar = $db->prepare($sql);
    $cambiar->execute(['id' => $completar_id]);
}

//AGREGAR UN MENSAJE DE BIENVENIDA DEPENDIENDO DE GENERO

function recuperarGenero($id_user)
{
    $db = conection();
    $sql = "SELECT Genero FROM UserForTasklist WHERE id = :id";
    $vergenero = $db->prepare($sql);
    $vergenero->execute(['id' => $id_user]);
    return $vergenero->fetchAll(PDO::FETCH_ASSOC);
}

//PERFIL OPCION DE BORRAR CUENTA DIRECTAMENTE DELETE FROM id
function deleteByIdPerfil($id)
{
    $db = conection();
    $sql = "DELETE FROM UserForTasklist WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $id]);
}

//BORRAR TODAS LAS TAREAS AL MISMO TIEMPO

function borrarTodasLasTareas($id)
{
    $db = conection();
    $sql = "DELETE FROM Tasklist WHERE id_user = :id_user";
    $eliminar = $db->prepare($sql);
    $eliminar->execute(['id_user' => $id]);
}


//VER PERFIL
function verPerfil($id)
{
    $db = conection();
    $sql = "SELECT * FROM UserForTasklist WHERE id = :id";
    $ver = $db->prepare($sql);
    $ver->execute([
        'id' => $id
    ]);
    return $ver->fetchAll(PDO::FETCH_ASSOC);
}
//CAMBIAR CONTRASENA
function updatepassword($id, $password)
{
    $db = conection();
    $sql = "UPDATE UserForTasklist SET Password = :password WHERE id = :id";
    $cambiar = $db->prepare($sql);
    $cambiar->execute(['id' => $id, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
}

//FUNCION AGREGAR FOTO DE PERFIL
function agregarFoto($fotoRuta,$userId){
    $db = conection();
    $sql = "UPDATE UserForTasklist SET Foto = :Foto WHERE id = :id";
    $agregar = $db -> prepare($sql);    
    $agregar->execute([
        'Foto' => $fotoRuta,
        'id'=> $userId
    ]);
}   

//FUNCION PARA VER IMAGENES
function verFoto($id){
    $db = conection();
    $sql = "SELECT Foto FROM UserForTasklist WHERE id = :id";
    $Fotos = $db -> prepare($sql);
    $Fotos -> execute(['id' => $id]);
    return $Fotos -> fetchColumn();
}

//FUNCION PARA INSERTAR POST
function insertPost($id_user,$titulo,$contenido,$fecha){
    $db = conection();
    $sql = "INSERT INTO Post (id_user, Titulo, Contenido, Fecha) 
    VALUES (? , ? , ?, ?)";
    $insertar = $db -> prepare($sql);
   return $insertar -> execute([
         $id_user,
         $titulo,
         $contenido,
         $fecha
    ]);
}

//FUNCION PARA VER LOS POST EN GENERAL

function getAllPost(){
    $db = conection();
    $sql = "SELECT Post.id_user, UserForTasklist.User, UserForTasklist.Foto , Post.Titulo, Post.Fecha, Post.Contenido
            FROM Post 
            INNER JOIN UserForTasklist ON Post.id_user = UserForTasklist.id";
    $verPost = $db -> prepare($sql);
    $verPost -> execute();
     return $verPost -> fetchAll(PDO::FETCH_ASSOC);
}
//FUNCION PARA INSERTAR COMENTARIOS
//FUNCION PARA VER LOS COMENTARIOS