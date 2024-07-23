<?php 
include '../Auth/Alumno.php';
include '../Conexion.php';
$id_p = $_GET["id"];
$query_trash = "DELETE FROM proyecto WHERE id = '$id_p'";
mysqli_query($cn, $query_trash);
mysqli_close($cn);
header('Location: ./MisProyectos.php');
?>