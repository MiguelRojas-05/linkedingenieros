<?php
include '../Auth/Empresa.php';
include("../Conexion.php");

// Obtener el ID de la propuesta del parámetro de la URL
$IdPropuesta = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID es válido
if ($IdPropuesta <= 0) {
    die('ID de propuesta no válido.');
}

// Consulta para obtener los postulantes aceptados
$Sql = "SELECT a.codigo, a.nombre, a.a_paterno, a.a_materno, p.fecha_postulacion
        FROM postulacion p
        JOIN alumno a ON p.codigo_alumno = a.codigo
        WHERE p.id_propuesta = $IdPropuesta AND p.estado = 'Aceptado'";

$Postulantes = mysqli_query($cn, $Sql);

if (!$Postulantes) {
    die('Error en la consulta: ' . mysqli_error($cn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulantes Seleccionados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />

    <style>
        .table-container {
            max-width: 800px; /* Ajusta este valor según el ancho deseado */
            margin: 0 auto;
        }
        .table th, .table td {
            text-align: center; /* Asegura que el texto en celdas esté centrado */
        }
    </style>
</head>

<body>

<?php  
include '../Componentes/NavBarEmpresa.php';
?>

    <div class="container mt-5">
        <h1 class="text-center">Postulantes Seleccionados</h1>

        <div class="table-container">
        <h1 class="text-center">Postulantes Seleccionados</h1>
            <?php if (mysqli_num_rows($Postulantes) > 0) : ?>
                <table class="table table-sm table-hover mt-3">
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Fecha de Postulación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($Postulante = mysqli_fetch_assoc($Postulantes)) : ?>
                            <tr>
                                <td>
                                    <a href="../PerfilAlumno.php?codigo=<?php echo htmlspecialchars($Postulante['codigo']); ?>" target="_blank">
                                        <?php echo htmlspecialchars($Postulante['nombre'] . ' ' . $Postulante['a_paterno'] . ' ' . $Postulante['a_materno']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($Postulante['fecha_postulacion']); ?></td>
                                <td>
                                    <a href="../CurriculumAlumnos/<?php echo htmlspecialchars($Postulante['codigo']); ?>.pdf" target="_blank" class="btn btn-primary btn-sm" style="background-color: #1f1d36; border-color: #040101; color: white; margin-right: 5px;">Ver CV</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="text-center">No hay postulantes seleccionados para esta propuesta.</p>
            <?php endif; ?>
        </div>
            <br><br>
        <div class="row d-flex justify-content-center mt-4">
            <div class="col col-2">
                <a href="VerPropuestasEmpresa.php" class="btn btn-primary">Ir Atras</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
