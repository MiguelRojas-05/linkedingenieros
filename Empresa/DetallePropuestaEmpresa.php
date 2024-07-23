<?php
include '../Auth/Empresa.php';
include("../Conexion.php");

// Obtener el ID de la propuesta del parámetro de la URL
$IdPropuesta = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID es válido
if ($IdPropuesta <= 0) {
    die('ID de propuesta no válido.');
}

// Consulta para obtener los detalles de la propuesta
$Sql = "SELECT nombre, descripcion, requerimientos, fecha_publi, fecha_limite, 
        CASE id_estado_propuesta 
            WHEN 1 THEN 'Activa' 
            WHEN 2 THEN 'Inactiva' 
            WHEN 3 THEN 'Inhabilitada'
            WHEN 4 THEN 'Borrada' 
        END AS estado
        FROM propuesta_laboral 
        WHERE id = $IdPropuesta AND codigo_empresa = '{$_SESSION["codigo_usuario"]}'";

$Propuesta = mysqli_query($cn, $Sql);

if (!$Propuesta || mysqli_num_rows($Propuesta) == 0) {
    die('No se encontró la propuesta.');
}

$Detalle = mysqli_fetch_assoc($Propuesta);

// Consulta para obtener los postulantes
$SqlPostulantes = "SELECT a.codigo, a.nombre, a.a_paterno, a.a_materno, p.fecha_postulacion, p.estado
                   FROM postulacion p
                   JOIN alumno a ON p.codigo_alumno = a.codigo
                   WHERE p.id_propuesta = $IdPropuesta";


$Postulantes = mysqli_query($cn, $SqlPostulantes);

if (!$Postulantes) {
    die('Error en la consulta de postulantes: ' . mysqli_error($cn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
    <link rel="icon" href="../img/Min_logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/EstiloDetallePropuesta.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

<?php  
include '../Componentes/NavBarEmpresa.php';
?>

    <div class="container" style="margin-top: 100px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-8 px-3">
                <h1>Detalles de mi Propuesta</h1>

                <table class="table table-sm table-hover">
                    <tr>
                        <td><b>Nombre:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['nombre']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Descripción:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['descripcion']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Requerimientos:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['requerimientos']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha de Publicación:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['fecha_publi']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha Límite:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['fecha_limite']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Estado:</b></td>
                        <td><?php echo htmlspecialchars($Detalle['estado']); ?></td>
                    </tr>
                </table>

                <!-- Sección de Postulantes -->
                <h2 class="mt-5">Postulantes</h2>
                    <?php if (mysqli_num_rows($Postulantes) > 0) : ?>
                        <table class="table table-sm table-hover mt-3">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Nombre Completo</th>
                                    <th style="text-align: center;">Fecha de Postulación</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($Postulante = mysqli_fetch_assoc($Postulantes)) : ?>
                                <tr>
                                    <td class="text-center">
                                        <a href="../PerfilAlumno.php?codigo=<?php echo htmlspecialchars($Postulante['codigo']); ?>" target="_blank">
                                            <?php echo htmlspecialchars($Postulante['nombre'] . ' ' . $Postulante['a_paterno'] . ' ' . $Postulante['a_materno']); ?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo htmlspecialchars($Postulante['fecha_postulacion']); ?></td>
                                    <td class="text-center">
                                        <?php if ($Postulante['estado'] !== 'Recibido') : ?>
                                            <!-- Enlace para Ver CV -->
                                            <form method="post" action="ProcesoAccionPostulantes.php" style="display:inline;">
                                                <input type="hidden" name="CodigoAlu" value="<?php echo htmlspecialchars($Postulante['codigo']); ?>">
                                                <input type="hidden" name="IdPropuesta" value="<?php echo htmlspecialchars($IdPropuesta); ?>">
                                                <!-- <button type="submit" name="Seleccion" value="marcar_recibido" class="btn btn-primary btn-sm" style="background-color: #1f1d36; border-color: #040101; color: white; margin-right: 5px;">Ver CV</button> -->
                                            </form>
                                        <?php else : ?>
                                            <!-- Enlace para Ver CV si ya está marcado como recibido -->
                                            <a href="../CurriculumAlumnos/<?php echo htmlspecialchars($Postulante['codigo']); ?>.pdf" target="_blank" class="btn btn-primary btn-sm" style="background-color: #1f1d36; border-color: #040101; color: white; margin-right: 5px;">Ver CV</a>
                                        <?php endif; ?>
                                        <?php if ($Postulante['estado'] !== 'Aceptado') : ?>
                                            <form method="post" action="ProcesoAccionPostulantes.php" style="display:inline;">
                                                <input type="hidden" name="CodigoAlu" value="<?php echo htmlspecialchars($Postulante['codigo']); ?>">
                                                <input type="hidden" name="IdPropuesta" value="<?php echo htmlspecialchars($IdPropuesta); ?>">
                                                <button type="submit" name="Seleccion" value="seleccionar_postulante" class="btn btn-primary btn-sm">Seleccionar postulante</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p class="mt-3">No hay postulantes para esta propuesta.</p>
                    <?php endif; ?>
                <br>
                <div class="row d-flex justify-content-center">
                    <div class="col col-2">
                        <a href="VerPropuestasEmpresa.php" class="btn btn-primary">Ir Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
