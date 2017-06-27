<?php
require_once 'bbdd.php';
session_start();
if (isset($_SESSION["user"])) {
    if ($_SESSION["type"] == 1) {
        if (isset($_POST['borrar'])) {
            $user = $_POST["username"];
            deleteUser($user);
            insertEvent($user, 'X');
        } else {
            echo "<form action='' method='post'>";
            echo "Seleciona el usuario a eliminar: ";
            echo "<select name='username'>";
            $nombres = selectUser();
            while ($fila = mysqli_fetch_array($nombres)) {
                extract($fila);
                echo "<option value='$username'>$username</option>";
            }
            echo "</select>";
            echo "<input type='submit' name='borrar' value='Eliminar usuario'>";
            echo "</form>";
        }
    }else {
        echo "No tienes permisos para ver esta página.";
    }
} else {
    echo "No se ha iniciado ninguna session.";
}
?>
