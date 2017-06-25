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
        header("refresh:3;url=index.php");
    } else {
        echo mysqli_error($conexion);
        header("refresh:3;url=registro.php");
    }
    desconectar($conexion);
}

function insertEvent($username, $type) {
    $con = conectar("msg");
    $insert = "insert into event values (null,'$username', now(),'$type')";
    if (mysqli_query($con, $insert)) {
        echo "<p>Evento registrado </p>";
    } else {
        echo mysqli_error($con);
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

// DELETE USER

function deleteUser($name) {
    $con = conectar("msg");
    $delete = "delete from event where user='$name'";
    if (mysqli_query($con, $delete)) {
        $delete = "delete from user where username='$name'";
        if (mysqli_query($con, $delete)) {
            echo "Usuario eliminado!";
            header("refresh:1;url=home_admin.php");
        } else {
            echo mysqli_error($con);
            echo "<form action='home_admin.php' method='post'>";
            echo "<input type='submit' value='Volver a la home'>";
            echo "</form>";
        }
    }else{
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
        header("refresh:3;url=home.php");
    } else {
        echo mysqli_error($con);
        header("refresh:3;url=home.php");
    }
    desconectar($con);
}
