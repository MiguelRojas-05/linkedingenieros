<?php
include'../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

// Extrayendo el valor de la variable 'idp' que llega desde la url, esto para capturar el id especifico de la propuesta a postular.
$IdPropuesta=$_GET["idp"];
$c = $_SESSION["codigo_usuario"];
// Consulta SQL para insertar una nueva fila a la tabla postulación
// Cambiar el codigo_alumno, extrayendolo por variables de sesión o por otro método. 
$Sql="insert into postulacion(codigo_alumno,id_propuesta,estado)
    values('$c',$IdPropuesta,'Enviado')";

mysqli_query($cn,$Sql);

//Redireccionar a Postulaciones.php
header('location: Postulaciones.php');
?>