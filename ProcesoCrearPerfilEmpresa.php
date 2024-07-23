<?php
//include("Auth.php");

include("Conexion.php");

$Codigo=$_POST["codigo"];

//Un ejemplo
//$Codigo='0332191025';

// Variables
$RazonSocial=$_POST["TextRazonSocial"];
$Ruc=$_POST["TextRuc"];
$Sector=$_POST["TextSector"];
$Descripcion=$_POST["TextDescripcion"];
$Direccion=$_POST["TextDireccion"];
$Celular=$_POST["TextCelular"];
$CorreoContacto=$_POST["TextCorreo"];
$SitioWeb=$_POST["TextSitioWeb"];

// Sentencia utilizada para agregar un registro a la tabla empresa
$Sql="insert into empresa(codigo,razon_social,ruc,
        sector,descripcion,direccion,celular,correo_contacto,sitio_web)
        values('$Codigo','$RazonSocial','$Ruc','$Sector','$Descripcion',
        '$Direccion','$Celular','$CorreoContacto','$SitioWeb')";

// Función que sirve para ejecutar consultas SQL en la base de datos Linkeding
mysqli_query($cn,$Sql);

// Función que redirecciona a otro página, en este caso IndexEmpresa.php
header('location: Login.php');

?>