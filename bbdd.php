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

//ISERTS

function newUser($username, $password, $name, $surname, $type) {
    $conexion = conectar("msg");
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

//SELECTS

function selectUser() {
    $con = conectar("msg");
    $query = "select * from user;";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

// DELETE USER

function deleteUser($name) {
    $con = conectar("royal");
    $delete = "delete from user where username='$name'";
    if (mysqli_query($con, $delete)) {
        echo "Usuario eliminado!";
        header("refresh:3;url=home_admin.php");
    } else {
        echo mysqli_error($con);
        header("refresh:3;url=home_admin.php");
    }
    desconectar($con);
}

//UPDATES

function updatePassword($password, $usuario) {
    $con = conectar("msg");
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
