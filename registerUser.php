<?php

require_once 'bbdd.php';
session_start();
if (isset($_SESSION["user"])) {
    if ($_SESSION["type"] == 1) {
        if (isset($_POST["registrar"])) {
            $usuario = $_POST["username"];
            $nombre = $_POST["name"];
            $apellido = $_POST["surname"];
            $tipo = $_POST["type"];
            if (comprobarUser($usuario)) {
                echo "<p>Usuario ya extstente.</p>";
            } else {
                $password1 = $_POST["pass1"];
                if ($password1 != $_POST["pass2"]) {
                    echo "<p>Las contraseñas no coinciden. </p>";
                } else {
                    newUserAdmin($usuario, $password1, $nombre, $apellido, $tipo);
                }
            }
        } else {
            echo '
        <form action = "" method = "POST">
        Nombre de usuario: <input type = "text" name = "username" required><br>
        Nombre: <input type = "text" name = "name" required><br>
        Apellido: <input type = "text" name = "surname" required><br>
        Contrasenya: <input type = "password" name = "pass1" required><br>
        Repetir contrasenya: <input type = "password" name = "pass2" required><br>
        Tipo de usuario [Admin: 1 or User: 0]: <input type = "number" name = "type" min="0" max="1" required><br>
        <input type = "submit" name = "registrar" value = "Registrar"><br>
        </form>';
        }
    } else {
        echo "No tienes permisos para ver esta página.";
    }
} else {
    echo "No se ha iniciado ninguna session.";
}
?>

