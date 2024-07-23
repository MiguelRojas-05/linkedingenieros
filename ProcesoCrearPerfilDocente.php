<?php
//include("Auth.php");

include("Conexion.php");

$Codigo=$_POST["codigo"];

// Variables
$Nombre=$_POST["nombre"];
$ApePaterno=$_POST["a_paterno"];
$ApeMaterno=$_POST["a_materno"];
$Correo=$_POST["correo"];


// Sentencia utilizada para agregar un registro a la tabla empresa
$Sql="insert into docente(codigo,nombre,a_paterno,
        a_materno,correo)
        values('$Codigo','$Nombre','$ApePaterno','$ApeMaterno','$Correo')";

// Función que sirve para ejecutar consultas SQL en la base de datos Linkeding
mysqli_query($cn,$Sql);

// Función que redirecciona a otro página, en este caso IndexEmpresa.php
header('location: Login.php');

?>