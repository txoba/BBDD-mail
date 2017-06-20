<?php
require_once('bbdd.php');
if (isset($_POST["enviar"])) {
    $usuario = $_POST["username"];
    $nombre = $_POST["name"];
    $apellido = $_POST["surname"];
    $contra = $_POST["pass1"];
    $pass2 = $_POST["pass2"];   
    
    if($contra==$pass2){
        newUser($usuario, $contra, $nombre, $apellido, 0);
    }else{
        echo "Las contrasenyas no coinciden";
        header("refresh:3;url=registro.php");
    }
} else {
    echo ' 
        <form action = "" method = "POST">
        Nombre de usuario: <input type = "text" name = "username" required><br>
        Nombre: <input type = "text" name = "name" required><br>
        Apellido: <input type = "text" name = "surname" required><br>
        Contrasenya: <input type = "password" name = "pass1" required><br>
        Repetir contrasenya: <input type = "password" name = "pass2" required><br>
        <input type = "submit" name = "enviar" value = "Registrarse"><br>
        </form>';
}
?>