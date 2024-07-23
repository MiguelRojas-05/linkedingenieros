<?php
include '../Auth/Alumno.php';
include '../Conexion.php';

$id_p =$_POST["id_pro"];
$nombre = $_POST["nombre"];
$descripcion = trim($_POST["descripcion"]);
$url = $_POST["url"];
$f_i = $_POST["fecha_inicio"];
$f_f = $_POST["fecha_fin"];

$query = "UPDATE proyecto SET nombre = '$nombre', descripcion = '$descripcion', fecha_inicio = '$f_i', fecha_fin = '$f_f', estado = 0 WHERE id = '$id_p'";

mysqli_query($cn, $query);
mysqli_close($cn);
Header('Location: MisProyectos.php');


?>