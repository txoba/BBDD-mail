<?php

require_once 'bbdd.php';
session_start();
if (isset($_SESSION["user"])) {
    if ($_SESSION["type"] == 1) {
        echo "<form action='' method='post'>";
        echo'<table style="width:35%" border="1">';
        echo "<tr><th>Username</th><th>Password</th><th>Name</th>"
        . "<th>Surname</th><th>Type</th></tr>";
        $user = selectUser();
        while ($fila = mysqli_fetch_array($user)) {
            extract($fila);
            echo "<tr><td>$username</td><td>$password</td><td>$name</td>"
            . "<td>$surname</td><td>$type</td></tr>";
        }
        echo'</table>';
        echo "</form>";
        echo "<form action='home.php' method='post'>";
        echo "<input type='submit' value='Volver a la home'>";
        echo "</form>";
    } else {
        echo "No tienes permisos para ver esta página.";
    }
} else {
    echo "No se ha iniciado ninguna session.";
}