<?php
include("../Auth/Empresa.php");
include("../Conexion.php");

$Codigo=$_SESSION["codigo_usuario"];

$Nombre=$_POST["TxtNombre"];
$Descripcion=$_POST["TxtDescripcion"];
$Requerimientos=$_POST["TxtRequerimientos"];

$FechaLimite=$_POST["FechaLimite"];
$IdEstadoPropuesta=1;

$Sql="insert into propuesta_laboral
set nombre='$Nombre',
descripcion='$Descripcion',
requerimientos='$Requerimientos',
fecha_publi=CURRENT_TIMESTAMP,
fecha_limite='$FechaLimite',
codigo_empresa='$Codigo',
id_estado_propuesta=$IdEstadoPropuesta";


// Función que sirve para ejecutar consultas SQL en la base de datos Linkeding
mysqli_query($cn,$Sql);

// Función que redirecciona a otro página, en este caso IndexEmpresa.php
header('location: VerPropuestasEmpresa.php');

?>