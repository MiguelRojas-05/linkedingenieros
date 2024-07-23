<?php
// Iniciar sesión 
include '../Auth/Docente.php';
include("../Conexion.php");

// Consulta SQL actualizada para obtener solo las propuestas activas
$Sql = "SELECT p.id, p.nombre, p.fecha_publi, p.fecha_limite, 
        CASE p.id_estado_propuesta 
            WHEN 1 THEN 'Activa' 
            WHEN 2 THEN 'Inactiva' 
        END AS estado,
        e.razon_social AS nombre_empresa
        FROM propuesta_laboral p
        JOIN empresa e ON p.codigo_empresa = e.codigo
        WHERE p.id_estado_propuesta = 1"; // Filtrar solo las propuestas activas

// Ejecutar la consulta
$Propuestas = mysqli_query($cn, $Sql);

if (!$Propuestas) {
    die('Error en la consulta: ' . mysqli_error($cn));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propuestas Laborales</title>
    <link rel="stylesheet" href="../css/EstiloVerPropuestasDocente.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

<?php  
include '../Componentes/NavBarDocente.php';
?>

    <div class="ContainerPropuestaAlumno">
        <h1>Propuestas Laborales Disponibles</h1>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Opciones</th>
                    <th>Empresa</th> <!-- Nueva columna para el nombre de la empresa -->
                    <th>Fecha Límite</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($R = mysqli_fetch_assoc($Propuestas)) {
                    echo "<tr>";
                    echo "<td>" . $R['nombre'] . "</td>";
                    echo "<td><a id='ancor' href='DetallePropuestaDocente.php?id=" . $R['id'] . "'>Ver Detalles</a> <a id='ancor' href='VerPostulantesDocente.php?id=" . $R['id'] . "'>Ver Postulantes</a> </td>";
                    echo "<td>" . $R['nombre_empresa'] . "</td>"; // Mostrar el nombre de la empresa
                    echo "<td>" . $R['fecha_limite'] . "</td>";
                    echo "</tr>";
                }
                mysqli_close($cn);
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>