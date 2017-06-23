<?php
session_start();
require_once 'bbdd.php';
if (isset($_SESSION["username"])) {
    // Nos aseguramos que el usuario sea administrador
    // Cogemos el tipo de la variable de sesión
    $tipo = $_SESSION["tipo"];
    if ($tipo == 1) {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title></title>
            </head>
            <body>
                <h1>HOME ADMIN</h1>
                <a href="modificarPassword.php">Cambiar Password</a><br>
                <a href="send.php">Enviar mensaje</a><br>
                <a href="messages.php">Bandeja de entrada</a><br>
                <a href="sentMsg.php">Mensajes enviados</a><br>
                <br>Opciones de administrador<br><br>
                <a href="listUser.php">Listado usuarios</a><br>
                <a href="registerUser.php">Registrar usuario</a><br>
                <a href="deleteUser.php">Eliminar usuario</a><br>
                <a href="listMessages.php">Listado mensajes del sistema</a><br>
                <a href="lastLogin.php">Info ultimo inicio sesion de un usuario</a><br>
                <a href="rankingUser.php">Ranking usuarios por cantidad de mensajes</a><br><br>
                <form action='index.php' method='post'>
                    <input type='submit' value='Cerrar Sesion'>
                </form>
            </body>
        </html>
<?php
    } else {
        echo "<p>No tienes permisos para ver esta página.</p>";
    }
} else {
    echo "<p>No hay usuario validado</p>";
}
?>