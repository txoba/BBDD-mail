<?php

require_once 'bbdd.php';
if (isset($_POST["registrar"])) {
    $usuario = $_POST["username"];
    $nombre = $_POST["name"];
    $apellido = $_POST["surname"];
    if (comprobarUser($usuario)) {
        echo "<p>Usuario ya extstente.</p>";
    } else {
        $password1 = $_POST["pass1"];
        if ($password1 != $_POST["pass2"]) {
            echo "<p>Las contraseñas no coinciden. </p>";
        } else {
            newUser($usuario, $password1, $nombre, $apellido, 0);
        }
    }
} else if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $pass = $_POST["password"];
    if (validateUser($username, $pass)) {
        session_start();
        $_SESSION["user"] = $username;
        $tipo = selectType($username);
        insertEvent($_SESSION["user"], 'I');
        $_SESSION["type"] = $tipo;
        if ($tipo == 0) {
            header("refresh:1;url=home.php");
        } else if ($tipo == 1) {
            header("refresh:1;url=home.php");
        }
    } else {
        echo "<p>Usuario o password incorrectos.</p>";
        header("refresh:1;url=index.php");
    }
} else {
        echo 'REGISTRO:<br>
        <form action = "" method = "POST">
        Nombre de usuario: <input type = "text" name = "username" required><br>
        Nombre: <input type = "text" name = "name" required><br>
        Apellido: <input type = "text" name = "surname" required><br>
        Contrasenya: <input type = "password" name = "pass1" required><br>
        Repetir contrasenya: <input type = "password" name = "pass2" required><br>
        <input type = "submit" name = "registrar" value = "Registrarse"><br>
        </form>';
        
        echo 'INICIAR SESION:<br>
        <form action = "" method = "POST">
        Nombre de usuario: <input type = "text" name = "username" required><br>
        Contrasenya: <input type = "password" name = "password" required><br>
        <input type = "submit" name = "login" value = "Iniciar Sesion"><br>
        </form>';
}
?>

