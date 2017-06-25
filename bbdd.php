<?php

//CONECTAR

function conectar($database) {
    $conexion = mysqli_connect("localhost", "root", "", $database)
            or die("No se ha podido conectar a la BBDD");
    return $conexion;
}

//DESCONECTAR

function desconectar($conexion) {
    mysqli_close($conexion);
}

//INSERTS

function newUser($username, $password, $name, $surname, $type) {
    $conexion = conectar("msg");
    //$hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = "insert into user values('$username', '$password', '$name', '$surname', $type)";
    if (mysqli_query($conexion, $insert)) {
            echo "Usuario dado de alta.<br>";
            header("refresh:1;url=index.php");
    } else {
        echo mysqli_error($conexion);
        echo "<form action='index.php' method='post'>";
            echo "<input type='submit' value='Volver'>";
            echo "</form>";
    }
    desconectar($conexion);
}

function newUserAdmin($username, $password, $name, $surname, $type) {
    $conexion = conectar("msg");
    //$hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = "insert into user values('$username', '$password', '$name', '$surname', $type)";
    if (mysqli_query($conexion, $insert)) {
        echo "Usuario dado de alta.<br>";
            header("refresh:1;url=home.php");
    } else {
        echo mysqli_error($conexion);
        echo "<form action='home.php' method='post'>";
            echo "<input type='submit' value='Volver'>";
            echo "</form>";
    }
    desconectar($conexion);
}
function insertEvent($username, $type) {
    $con = conectar("msg");
    $insert = "insert into event values (null,'$username', now(),'$type')";
    if (mysqli_query($con, $insert)) {
    } else {
        echo mysqli_error($con);
        echo "<form action='home.php' method='post'>";
        echo "<input type='submit' value='Volver'>";
        echo "</form>";
    }
    desconectar($con);
}
function insertMessage($sender, $reciver, $subject, $body) {
    $con = conectar("msg");
    $tipo = selectUser();
    $fila = mysqli_fetch_array($tipo);
    extract($fila);
    $insert = "insert into message values (null,'$sender', '$reciver' , now() , 0 , '$subject', '$body')";
    if (mysqli_query($con, $insert)) {
            echo "Mensaje enviado.<br>";
            header("refresh:1;url=home.php");
    } else {
        echo mysqli_error($con);
        echo "<form action='send.php' method='post'>";
        echo "<input type='submit' value='Volver'>";
        echo "</form>";
    }
    desconectar($con);
}

//SELECTS

function selectUser() {
    $con = conectar("msg");
    $query = "select * from user;";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}
function selectEventByUser($username) {
    $conexion = conectar("msg");
    $query = "select * from event where user='$username'";
    $resultado = mysqli_query($conexion, $query);
    desconectar($conexion);
    return $resultado;
}
function validarPassword($username) {
    $conexion = conectar("msg");
    $query = "select password from user where username='$username'";
    $resultado = mysqli_query($conexion, $query);
    desconectar($conexion);
    return $resultado;
}
function comprobarUser($username) {
    $con = conectar("msg");
    $query = "select username from user where username='$username'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    $num_rows = mysqli_num_rows($resultado);
    if ($num_rows == 0) {
        return false;
    }
}
function selectType($username) {
    $conexion = conectar("msg");
    $select = "select type from user where username='$username'";
    $resultado = mysqli_query($conexion, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($conexion);
    return $type;
}
function selectMessage($posicion, $cantidad, $username) {
    $con = conectar("msg");
    $select = "select * from message where receiver='$username' limit $posicion,$cantidad";
    $resultado = mysqli_query($con, $select) or die(mysql_error());
    desconectar($con);
    return $resultado;
}
function selectMessage2($posicion, $cantidad, $username) {
    $con = conectar("msg");
    $select = "select * from message where sender='$username' limit $posicion,$cantidad";
    $resultado = mysqli_query($con, $select) or die(mysql_error());
    desconectar($con);
    return $resultado;
}
function selectMessageAll() {
    $con = conectar("msg");
    $select = "select * from message";
    $resultado = mysqli_query($con, $select) or die(mysql_error());
    desconectar($con);
    return $resultado;
}
function selectMessageId($idmessage) {
    $con = conectar("msg");
    $select = "select body from message where idmessage='$idmessage'";
    $resultado = mysqli_query($con, $select) or die(mysql_error());
    desconectar($con);
    return $resultado;
}
function contadorMensages($username) {
    $con = conectar("msg");
    $select = "select count(*) as count from message where receiver='$username'";
    $resultado = mysqli_query($con, $select)or die(mysql_error());
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $count;
}
function contadorMensages3($username) {
    $con = conectar("msg");
    $select = "select count(*) as count from message where sender='$username'";
    $resultado = mysqli_query($con, $select)or die(mysql_error());
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $count;
}
function contadorMensages2() {
    $con = conectar("msg");
    $select = "select count(*) as count from message";
    $resultado = mysqli_query($con, $select)or die(mysql_error());
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $count;
}

// DELETE USER

function deleteUser($name) {
    $con = conectar("msg");
    $delete = "delete from event where user='$name'";
    if (mysqli_query($con, $delete)) {
        $delete = "delete from user where username='$name'";
        if (mysqli_query($con, $delete)) {
            echo "Usuario eliminado!";
            header("refresh:1;url=home.php");
        } else {
            echo mysqli_error($con);
            echo "<form action='home.php' method='post'>";
            echo "<input type='submit' value='Volver a la home'>";
            echo "</form>";
        }
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

//UPDATES

function updatePassword($password, $usuario) {
    $con = conectar("msg");
    //$hash = password_hash($password, PASSWORD_DEFAULT);
    $update = "update user set password='$password' where username='$usuario'";
    if (mysqli_query($con, $update)) {
        echo "Password actualizada.";
        header("refresh:1;url=home.php");
    } else {
        echo mysqli_error($con);
        echo "<form action='home.php' method='post'>";
        echo "<input type='submit' value='Volver a la home'>";
        echo "</form>";
    }
    desconectar($con);
}
function messageUpdate($id) {
    $con = conectar("msg");
    $update = "update message set `read`=1 where idmessage=$id";
    if (mysqli_query($con, $update)) {
        
    } else {
        echo mysqli_error($con);
        echo "<form action='home.php' method='post'>";
        echo "<input type='submit' value='Volver a la home'>";
        echo "</form>";
    }
    desconectar($con);
}
