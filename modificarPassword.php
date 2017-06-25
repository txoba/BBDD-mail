<?php

require_once 'bbdd.php';
session_start();
if (isset($_SESSION["user"])) {
    if (isset($_POST["change"])) {
        $password = $_POST["password"];
        if (validarPassword($_SESSION["user"], $password)) {
            $nueva = $_POST["pass1"];
            $verificar = $_POST["pass2"];
            if ($nueva == $verificar) {
                changePassword($_SESSION["user"], $nueva);
            } else {
                echo 'Las contraseñas no coinciden';
            }
        } else {
            echo "Contraseña erronea";
        }
    } else {
        echo ' 
        <form action = "" method = "POST">
        Password actual: <input type = "password" name = "password" required><br>
        Nueva password: <input type = "password" name = "pass1" required><br>
        Repetir password: <input type = "password" name = "pass2" required><br>
        <input type = "submit" name = "enviar" value = "Cambiar paswword"><br>
        </form>';
    }
} else {
    echo "No se ha iniciado ninguna session.";
}
?>
