<?php

include '../Auth/Empresa.php';
include("../Conexion.php");

// Obtener el código del usuario
$Codigo = $_SESSION["codigo_usuario"];

// Consulta SQL para obtener los datos de la propuesta, incluyendo el estado
$Sql = "SELECT id, nombre, fecha_publi, fecha_limite, 
        CASE id_estado_propuesta 
            WHEN 1 THEN 'Activa' 
            WHEN 2 THEN 'Inactiva'
            WHEN 3 THEN 'Inhabilitada'
            WHEN 4 THEN 'Borrada'  
            END AS estado
            FROM propuesta_laboral 
            WHERE codigo_empresa = '$Codigo' 
            AND id_estado_propuesta IN (1, 2);";

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
    <link rel="stylesheet" href="../css/EstiloVerPropuestasEmpresa.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
    
    <script>//script evitar que se borre por accidente
        function ConfirmarEliminacion(event) {
            if (!confirm("¿Estás seguro de que quieres eliminar esta propuesta?")) {
                event.preventDefault(); 
            }
        }
    </script>

</head>

<body>

<?php  
include '../Componentes/NavBarEmpresa.php';
?>

    <div class="ContainerPropuesta text-center">
        <h1>Mis Propuestas Laborales</h1>

        <table>
            <thead>
                <tr>
                    <th class="center">Nombre</th>
                    <th class="center">Fecha de Publicación</th>
                    <th class="center">Fecha Límite</th>
                    <th class="center">Estado</th>
                    <th class="center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($R = mysqli_fetch_assoc($Propuestas)) {
                    echo "<tr>";
                    echo "<td><a id='ancor' href='DetallePropuestaEmpresa.php?id=" . $R['id'] . "'>" . $R['nombre'] . "</a></td>";
                    echo "<td class='center'>" . $R['fecha_publi'] . "</td>";
                    echo "<td class='center'>" . $R['fecha_limite'] . "</td>";
                    echo "<td class='center'>" . $R['estado'] . "</td>";
                    echo "<td class='center opciones'>
                            <a id='ancor' href='EditarPropuesta.php?id=" . $R['id'] . "'>Editar</a>
                            <a id='ancor' href='VerSeleccionados.php?id=" . $R['id'] . "'>Ver Seleccionados</a>
                            <a id='ancor' href='ProcesoEliminarPropuesta.php?id=" . $R['id'] . "' onclick='ConfirmarEliminacion(event)'>Eliminar</a>
                        </td>";
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