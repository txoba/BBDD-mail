<?php
require_once 'bbdd.php';
echo "<form action='' method='post'>";
echo'<table style="width:20%" border="1">';
echo "<tr><th>Ganador</th><th>Victorias</th>";
$msg = rankingMessages();
while ($fila = mysqli_fetch_array($msg)) {
    extract($fila);
    echo "<tr><td>$sender</td><td>$NumeroMessage</td>";
}
echo'</table>';
echo "</form>";
echo "<form action='index.php' method='post'>";
echo "<input type='submit' value='Volver a la home'>";
echo "</form>";