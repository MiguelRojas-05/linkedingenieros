<?php
include '../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

$c = $_SESSION["codigo_usuario"];

$Habilidad=$_POST["lsthabilidad"];
$Nivel=$_POST["nivel"];
// Consulta SQL para insertar una nueva fila a la tabla detalle habilidad alumno
$Sql="insert into detalle_habilidad_alumno(codigo_alumno,id_habilidad,nivel)
    values('$c',$Habilidad,'$Nivel')";

mysqli_query($cn,$Sql);

//Redireccionar a MisHabilidades.php
header('location: MisHabilidades.php');
?>