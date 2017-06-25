<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'bbdd.php';
        session_start();
        if (isset($_SESSION["user"])) {
            ?>
            <form action="" method="POST">
                <p>Destinatario: 
                    <select name="destinatario">
                        <?php
                        $destino = selectUser();
                        while ($fila = mysqli_fetch_array($destino)) {
                            extract($fila);
                            ?>
                            <option value="<?php echo $username ?>"><?php echo $username ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </p>
                <p>Asunto: <input type="text" name="asunto" required /></p>
                <p>Mensaje: <textarea name="mensaje" rows="10" cols="40" required></textarea></p>
                <p><input type="submit" name="enviar" value="Enviar" /> </p>
            </form>
            <?php
            if (isset($_POST["enviar"])) {
                $reciver = $_POST["destinatario"];
                $subject = $_POST["asunto"];
                $body = $_POST["mensaje"];
                insertMessage($_SESSION["user"], $reciver, $subject, $body);
                insertEvent($_SESSION["user"], 'R');
            }
        } else {
            echo "No se ha iniciado ninguna session.";
        }
        ?>
    </body>
</html>
