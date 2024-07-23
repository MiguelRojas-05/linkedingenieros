<?php
include '../Auth/Empresa.php';
include("../Conexion.php");

// Obtener los datos del formulario
$IdPropuesta = isset($_POST['id']) ? intval($_POST['id']) : 0;
$NuevoEstado = isset($_POST['EstadoNuevo']) ? intval($_POST['EstadoNuevo']) : 0;

// Verificar si el ID y el estado son válidos
if ($IdPropuesta <= 0 || $NuevoEstado <= 0) {
    die('Datos no válidos.');
}

$Codigo = $_SESSION["codigo_usuario"];

// Consulta SQL para actualizar el estado de la propuesta
$Sql = "UPDATE propuesta_laboral 
        SET id_estado_propuesta = $NuevoEstado
        WHERE id = $IdPropuesta AND codigo_empresa = '$Codigo'";

if (mysqli_query($cn, $Sql)) {
    // Redireccionar a la página de ver propuestas si la actualización fue exitosa
    header('Location: VerPropuestasEmpresa.php');
} else {
    die('Error al actualizar el estado: ' . mysqli_error($cn));
}

mysqli_close($cn);
?>
