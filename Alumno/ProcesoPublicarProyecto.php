<?php
include '../Auth/Alumno.php';
include '../Conexion.php';

$codi_alumno = $_SESSION["codigo_usuario"];

$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$url = $_POST["url"];
$f_i = $_POST["fecha_inicio"];

$f_f = $_POST["fecha_fin"];
$query = "INSERT INTO proyecto (nombre, descripcion, url, fecha_inicio, fecha_fin, estado) VALUES ('$nombre','$descripcion','$url','$f_i','$f_f',0);";

mysqli_query($cn, $query);

$query_id = "SELECT * FROM proyecto p WHERE p.nombre = '$nombre'";
$res = mysqli_query($cn, $query_id);
$date = mysqli_fetch_array($res);
$id_proyecto = $date["id"];
$sql_detalle = "INSERT INTO detalle_alumno_proyecto (codigo_alumno, id_proyecto, rol) VALUES ('$codi_alumno','$id_proyecto', 'líder' );";
mysqli_query($cn, $sql_detalle);
mysqli_close($cn);
Header('Location: MisProyectos.php');
?>
