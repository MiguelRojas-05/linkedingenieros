<?php
include '../Auth/Alumno.php';
include '../Conexion.php';

$c=$_SESSION["codigo_usuario"];

$Nombre=$_POST["txtnombre"];
$Ap=$_POST["txtap"];
$Am=$_POST["txtam"];
$Escuela=$_POST["lstescuela"];
$Celular=$_POST["txtcel"];

$sql="update alumno set nombre='$Nombre',
a_paterno='$Ap',a_materno='$Am',
escuela='$Escuela',celular='$Celular'
where codigo='$c'";


if(mysqli_query($cn,$sql)){
    header('location:ActualizarPerfilAlumno.php?mensaje=Actualización Exitosa');
}
// Cerrar la conexión a la base de datos
mysqli_close($cn);
?>