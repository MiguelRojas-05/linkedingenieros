<?php
include '../Conexion.php';
include '../Auth/Admin.php';


$Codigo = $_POST["codigo"];
$Correo = $_POST["correo"];
$Nombre = $_POST["nombre"];
$Pass = $_POST["pass"];
$Repass = $_POST["repass"];

if ($Pass !== $Repass) {
    header('location: Administradores.php');
    exit();
}
//No se verifica si está dentro de la tabla de bd_usuarios porque lo está añadiendo el mismo administrador, po lo tanto se salta esa valla de seguridad.

$q1 = "INSERT INTO usuario (codigo_usuario, correo, password, id_tipo_usuario, id_estado_usuario) VALUES ('$Codigo','$Correo','$Pass',4,1)";
$q2 = "INSERT INTO administrador (codigo, nombre) VALUES ('$Codigo','$Nombre')";
mysqli_query($cn, $q1);
mysqli_query($cn, $q2);
header('Location: Administradores.php');

?>