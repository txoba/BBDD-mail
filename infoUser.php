<?php

require_once 'bbdd.php';
session_start();
if (isset($_SESSION["user"])) {
    if ($_SESSION["type"] == 1) {
        if (isset($_POST['mostrar'])) {
            echo "<form action='' method='post'>";
            echo'<table style="width:35%" border="1">';
            echo "<tr><th>ID Evento</th><th>Fecha</th><th>Tipo</th></tr>";
            $username = $_POST["username"];
            $evento = selectEventByUser($username);
            while ($fila = mysqli_fetch_array($evento)) {
                extract($fila);
                $estado = 'Mensaje enviado';
                if ($type == "I") {
                    $estado = 'Inicio Sesion';
                }if ($type == "U") {
                    $estado = 'Modificar password';
                }if ($type == "C") {
                    $estado = 'Mensaje leido';
                }if ($type == "X") {
                    $estado = 'Usuario eliminado';
                }
                echo "<tr><td>$idevent</td><td>$date</td><td>$estado</td></tr>";
            }
            echo'</table>';
            echo "</form>";
            echo "<form action='home.php' method='post'>";
            echo "<input type='submit' value='Volver a la home'>";
            echo "</form>";
        } else {
            echo "<form action='' method='post'>";
            echo "Seleciona el usuario: ";
            echo "<select name='username'>";
            $nombres = selectUser();
            while ($fila = mysqli_fetch_array($nombres)) {
                extract($fila);
                echo "<option value='$username'>$username</option>";
            }
            echo "</select>";
            echo "<input type='submit' name='mostrar' value='Ver info'>";
            echo "</form>";
        }
    } else {
        echo "No tienes permisos para ver esta página.";
    }
} else {
    echo "No se ha iniciado ninguna session.";
}