<?php
include '../Auth/Empresa.php';
include("../Conexion.php");

// Verificar si se recibieron los parámetros necesarios
if (!isset($_POST['CodigoAlu'], $_POST['IdPropuesta'], $_POST['Seleccion'])) {
    die('Faltan parámetros.');
}

$CodigoAlumno = intval($_POST['CodigoAlu']);
$IdPropuesta = intval($_POST['IdPropuesta']);
$Accion = $_POST['Seleccion'];

// Validar los valores recibidos
if ($CodigoAlumno <= 0 || $IdPropuesta <= 0 || !in_array($Accion, ['marcar_recibido', 'seleccionar_postulante'])) {
    die('Parámetros inválidos.');
}

// Definir el nuevo estado basado en la acción
if ($Accion === 'marcar_recibido') {
    $NuevoEstado = 'Recibido';
} elseif ($Accion === 'seleccionar_postulante') {
    $NuevoEstado = 'Aceptado';
}

// Consulta para actualizar el estado del postulante en la tabla 'postulacion'
$Sql = "UPDATE postulacion 
        SET estado = ? 
        WHERE codigo_alumno = ? AND id_propuesta = ?";

// Preparar y ejecutar la consulta
$stmt = mysqli_prepare($cn, $Sql);

if (!$stmt) {
    die('Error en la preparación de la consulta: ' . mysqli_error($cn));
}

mysqli_stmt_bind_param($stmt, 'sii', $NuevoEstado, $CodigoAlumno, $IdPropuesta);

if (!mysqli_stmt_execute($stmt)) {
    die('Error en la ejecución de la consulta: ' . mysqli_stmt_error($stmt));
}

// Cerrar la declaración y la conexión
mysqli_stmt_close($stmt);
mysqli_close($cn);

// Redirigir al usuario a la página de propuestas después de la actualización
header('Location: DetallePropuestaEmpresa.php?id=' . $IdPropuesta);
exit();
?>
