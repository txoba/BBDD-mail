<?php

session_start();
require_once "bbdd.php";
if (isset($_SESSION["user"])) {
    $idmensaje = $_GET["idmessage"];
    $message = selectMessageId($idmensaje);
    $fila = mysqli_fetch_array($message);
    extract($fila);
    echo $body;
    messageUpdate($idmensaje);
    echo "<form action='mensajesRecibidos.php' method='post'>";
    echo "<input type='submit' value='Volver'>";
    echo "</form>";
} else {
    echo "<p>No hay usuario validado</p>";
}