<?php

require_once './bbdd.php';
if (isset($_POST["registrar"])) {
    $usuario = $_POST["username"];
    $nombre = $_POST["name"];
    $apellido = $_POST["surname"];
    if (comprobarUser($usuario)) {
        echo "<p>Usuario ya extstente.</p>";
    } else {
        $password = $_POST["pass1"];
        if ($password != $_POST["pass2"]) {
            echo "<p>Las contraseñas no coinciden. </p>";
        } else {
            newUser($usuario, $password, $nombre, $apellido, 0);
        }
    }
} else if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (validarPassword($username, $password)) {
        insertEvent($username, "I");
        session_start();
        $_SESSION["user"] = $username;
        $tipo = getTypeByUsername($username);
        $_SESSION["type"] = $tipo;
        if ($tipo == 0) {
            header("Location: User/home.php");
        } else if ($tipo == 1) {
            header("Location: Admin/home_admin.php");
        }
    } else {
        echo "<p>Usuario o contraseña incorrectos.</p>";
    }
} else {
        echo 'REGISTRO:<br>
        <form action = "" method = "POST">
        Nombre de usuario: <input type = "text" name = "username" required><br>
        Nombre: <input type = "text" name = "name" required><br>
        Apellido: <input type = "text" name = "surname" required><br>
        Contrasenya: <input type = "password" name = "pass1" required><br>
        Repetir contrasenya: <input type = "password" name = "pass2" required><br>
        <input type = "submit" name = "login" value = "Registrarse"><br>
        </form>';
        echo 'INICIAR SESION:<br>
        <form action = "" method = "POST">
        Nombre de usuario: <input type = "text" name = "username" required><br>
        Contrasenya: <input type = "password" name = "password" required><br>
        <input type = "submit" name = "registrar" value = "Registrarse"><br>
        </form>';
}
?>

<?php


?>