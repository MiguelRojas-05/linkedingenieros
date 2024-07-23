<?php
include '../Auth/Docente.php';
include '../Conexion.php';

$c=$_SESSION["codigo_usuario"];

$Nombre=$_POST["txtnombre"];
$Ap=$_POST["txtap"];
$Am=$_POST["txtam"];
$Correo=$_POST["txtemail"];

$sql="update docente set nombre='$Nombre',
a_paterno='$Ap',a_materno='$Am',
correo='$Correo'
where codigo='$c'";


if(mysqli_query($cn,$sql)){
    header('location:ActualizarPerfilDocente.php?mensaje3=Actualización Exitosa');
}
// Cerrar la conexión a la base de datos
mysqli_close($cn);
?>