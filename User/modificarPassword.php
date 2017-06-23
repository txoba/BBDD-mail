<?php
require_once('bbdd.php');
if (isset($_POST["enviar"])) {
    $passactual = $_POST["password"];
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];   
    
    $verify = selectUser();
    $fila = mysqli_fetch_array($verify);
    extract($fila);
    
    if($pass1==$pass2 && $passactual==$pasword){
        updatePassword($pass1,$usuario);
    }else{
        echo "Password incorrecta o no coinciden.";
        header("refresh:3;url=modificarPassword.php");
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
?>