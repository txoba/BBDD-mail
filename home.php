<?php
session_start();
require_once 'bbdd.php';
if (isset($_SESSION["user"])) {
    $tipo = $_SESSION["type"];
    if ($tipo == 1) {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title></title>
            </head>
            <body>
                <h1>HOME ADMIN: <?php echo $_SESSION["user"]?></h1>
                <a href="modificarPassword.php">Cambiar Password</a><br>
                <a href="send.php">Enviar mensaje</a><br>
                <a href="mensajesRecibidos.php">Bandeja de entrada</a><br>
                <a href="mensajesEnviados.php">Mensajes enviados</a><br>
                <br>Opciones de administrador<br><br>
                <a href="userList.php">Listado usuarios</a><br>
                <a href="registerUser.php">Registrar usuario</a><br>
                <a href="deleteUser.php">Eliminar usuario</a><br>
                <a href="messageList.php">Listado mensajes del sistema</a><br>
                <a href="infoUser.php">Info ultimo inicio sesion de un usuario</a><br>
                <a href="rankingUser.php">Ranking usuarios por cantidad de mensajes</a><br><br>
                <form action='logout.php' method='post'>
                    <input type='submit' value='Cerrar Sesion'>
                </form>
            </body>
        </html>
<?php
    }else if ($tipo == 0) {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title></title>
            </head>
            <body>
                <h1>HOME USER: <?php echo $_SESSION["user"]?></h1>
                <a href="modificarPassword.php">Cambiar Password</a><br>
                <a href="send.php">Enviar mensaje</a><br>
                <a href="mensajesRecibidos.php">Bandeja de entrada</a><br>
                <a href="mensajesEnviados.php">Mensajes enviados</a><br>
                <form action='logout.php' method='post'>
                    <input type='submit' value='Cerrar Sesion'>
                </form>
            </body>
        </html>
        <?php
    }else {
        echo "No tienes permisos para ver esta página.";
    }
} else {
    echo "<p>No hay usuario validado</p>";
}
?>