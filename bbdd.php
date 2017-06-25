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
function validarPassword($username, $pass) {
    $conexion = conectar("msg");
    $query = "select password from user where username='$username'";
    $result = mysqli_query($conexion, $query);
    $filas = mysqli_num_rows($result);
    desconectar($conexion);
    if ($filas > 0) {
        $fila = mysqli_fetch_array($result);
        extract($fila);
        return password_verify($pass, $password);
    }
}

// DELETE USER

function deleteUser($name) {
    $con = conectar("msg");
    $delete = "delete from user where username='$name'";
    if (mysqli_query($con, $delete)) {
        echo "Usuario eliminado!";
        header("refresh:3;url=home_admin.php");
    } else {
        echo mysqli_error($con);
        echo "<form action='/Admin/home_admin.php' method='post'>";
            echo "<input type='submit' value='Volver a la home'>";
            echo "</form>";
    }
    desconectar($con);
}

//UPDATES

function updatePassword($password, $usuario) {
    $con = conectar("msg");
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $update = "update user set password='$hash' where username='$usuario'";
    if (mysqli_query($con, $update)) {
        echo "Password actualizada.";
        header("refresh:3;url=home.php");
    } else {
        echo mysqli_error($con);
        header("refresh:3;url=home.php");
    }
    desconectar($con);
}
