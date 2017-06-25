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
    $message = selectMessageAll();
    $total = contadorMensages2();
    echo'<table style="width:35%" border="1">';
    echo "<tr><td>ID</td><th>Sender</th><td>Reciever</td><th>Fecha</th><th>Asunto</th><th>Estado</th></tr>";
    while ($fila = mysqli_fetch_array($message)) {
        extract($fila);
        $estado = 'No leido';
        if ($read == 1) {
            $estado = 'Leido';
        }
        echo "<tr><td>$idmessage</td><td>$sender</td><td>$receiver</td><td>$date</td><td><a href='mensajeAll.php?idmessage=" . $idmessage . "'>$subject</a></td><td>$estado</td></tr>";
    }
    echo "</table>";
    if ($posicion > 0) {
        echo "<a href='messageList.php?posicion=" . ($posicion - 15) . "'>&lt;&lt;</a>";
    }
    if ($posicion + 15 <= $total) {
        echo "Mostrando " . ($posicion + 1) . " al " . ($posicion + 15) . " de $total ";
    } else {
        echo "Mostrando " . ($posicion + 1) . " al $total de $total";
    }
    if ($posicion + 15 < $total) {
        echo "<a href='messageList.php?posicion=" . ($posicion + 1) . "'>&gt;&gt;</a>";
    }
    echo "<form action='home.php' method='post'>";
    echo "<input type='submit' value='Volver'>";
    echo "</form>";
} else {
    echo "<p>No hay usuario validado</p>";
}