<?php
include '../Auth/Empresa.php';
include("../Conexion.php");

// Obtener el ID de la propuesta del parámetro de la URL
$IdPropuesta = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID es válido
if ($IdPropuesta <= 0) {
    die('ID de propuesta no válido.');
}

$Codigo = $_SESSION["codigo_usuario"];

// Consulta SQL para actualizar el estado de la propuesta a 'Borrada' (4)
$Sql = "UPDATE propuesta_laboral 
        SET id_estado_propuesta = 4
        WHERE id = $IdPropuesta AND codigo_empresa = '$Codigo'";

if (mysqli_query($cn, $Sql)) {
    // Redireccionar a la página de ver propuestas si la actualización fue exitosa
    header('Location: VerPropuestasEmpresa.php');
} else {
    die('Error al actualizar el estado: ' . mysqli_error($cn));
}

mysqli_close($cn);
?>
