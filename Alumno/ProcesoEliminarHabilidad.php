<?php
include '../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

$c = $_SESSION["codigo_usuario"];
$Id = $_GET["id"];

// Consulta SQL para insertar una nueva fila a la tabla detalle habilidad alumno
$Sql="delete from detalle_habilidad_alumno
        where id_habilidad=$Id and codigo_alumno=$c";

mysqli_query($cn,$Sql);

//Redireccionar a MisHabilidades.php
header('location: MisHabilidades.php');
?>