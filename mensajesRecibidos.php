<?php

session_start();
require_once "bbdd.php";
if (isset($_SESSION["user"])) {
    $username = $_SESSION["user"];
    if (isset($_GET["posicion"])) {
        $posicion = $_GET["posicion"];
    } else {
        $posicion = 0;
    }
    $cantidad = 10;
    $message = selectMessage($posicion, $cantidad, $username);
    $total = contadorMensages($username);
    echo'<table style="width:35%" border="1">';
    echo "<tr><th>Sender</th><th>Fecha</th><th>Asunto</th><th>Estado</th></tr>";
    while ($fila = mysqli_fetch_array($message)) {
        extract($fila);
        $estado = 'No leido';
        if ($read == 1) {
            $estado = 'Leido';
        }
        echo "<tr><td>$sender</td><td>$date</td><td><a href='mensaje.php?idmessage=" . $idmessage . "'>$subject</a></td><td>$estado</td></tr>";
    }
    echo "</table>";
    if ($posicion > 0) {
        echo "<a href='mensajesRecibidos.php?posicion=" . ($posicion - 10) . "'>&lt;&lt;</a>";
    }
    if ($posicion + 10 <= $total) {
        echo "Mostrando " . ($posicion + 1) . " al " . ($posicion + 10) . " de $total ";
    } else {
        echo "Mostrando " . ($posicion + 1) . " al $total de $total";
    }
    if ($posicion + 10 < $total) {
        echo "<a href='mensajesRecibidos.php?posicion=" . ($posicion + 10) . "'>&gt;&gt;</a>";
    }
    echo "<form action='home.php' method='post'>";
    echo "<input type='submit' value='Volver'>";
    echo "</form>";
} else {
    echo "<p>No hay usuario validado</p>";
}