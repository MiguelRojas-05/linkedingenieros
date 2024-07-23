<?php
include("../Auth/Empresa.php");
include("../Conexion.php");

// Obtener el ID y otros datos del formulario
$IdPropuesta = isset($_POST['id']) ? intval($_POST['id']) : 0;
$Nombre = $_POST['TxtNom'];
$Descripcion = $_POST['TxtDescrip'];
$Requerimientos = $_POST['TxtReque'];
$FechaLimite = $_POST['TxtFechaL'];

// Verificar el id
if ($IdPropuesta <= 0) {
    die('ID de propuesta no válido.');
}

$Codigo = $_SESSION["codigo_usuario"];

// Consulta SQL para actualizar los datos de la propuesta
$Sql = "UPDATE propuesta_laboral
        SET nombre = '$Nombre', descripcion = '$Descripcion', requerimientos = '$Requerimientos', fecha_limite = '$FechaLimite'
        WHERE id = $IdPropuesta AND codigo_empresa = '$Codigo'";

if (mysqli_query($cn, $Sql)) {
    header('Location: VerPropuestasEmpresa.php');
    exit();
} else {
    die('Error al actualizar la propuesta: ' . mysqli_error($cn));
}

?>
