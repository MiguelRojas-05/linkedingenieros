<?php

include 'Conexion.php';

$codigo=$_POST["codigo"];
$nombre = $_POST['nombre'];
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno'];
$escuela = $_POST['escuela'];
$celular = $_POST['celular'];
$cv = 1; 


if ($cn->connect_error) {
    die("Conexión fallida: " . $cn->connect_error);
}

$sql = "INSERT INTO alumno (codigo, nombre, a_paterno, a_materno, escuela, celular, cv) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $cn->prepare($sql);
$stmt->bind_param("ssssssi", $codigo, $nombre, $a_paterno, $a_materno, $escuela, $celular, $cv);

if ($stmt->execute()) {
    header("Location: Login.php");
    exit();
} else {
    echo "Error al crear el perfil: " . $stmt->error;
}

$stmt->close();
$cn->close();
?>