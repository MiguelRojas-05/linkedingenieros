<?php
include '../Auth/Empresa.php';
include '../Conexion.php';

$c=$_SESSION["codigo_usuario"];

$RazonSocial=$_POST["TextRazonSocial"];
$Ruc=$_POST["TextRuc"];
$Sector=$_POST["TextSector"];
$Direccion=$_POST["TextDireccion"];
$Celular=$_POST["TextCelular"];
$Correo=$_POST["TextCorreo"];
$SitioWeb=$_POST["TextSitioWeb"];
$Descripcion=$_POST["TextDescripcion"];

$sql="update empresa set razon_social='$RazonSocial',
ruc='$Ruc',sector='$Sector',
descripcion='$Descripcion',direccion='$Direccion',
celular='$Celular',correo_contacto='$Correo',
sitio_web='$SitioWeb'
where codigo='$c'";


if(mysqli_query($cn,$sql)){
    header('location:ActualizarPerfilEmpresa.php?mensaje2=Actualización Exitosa');
}
// Cerrar la conexión a la base de datos
mysqli_close($cn);
?>