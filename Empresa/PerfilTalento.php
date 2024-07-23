<?php
session_start();
include('../Conexion.php');

// Extraer el código del alumno desde la URL
$CodigoUsuario = isset($_GET['codigo']) ? mysqli_real_escape_string($cn, $_GET['codigo']) : '';

// Consulta SQL para obtener los detalles del perfil del alumno junto con el correo electrónico
$Sql = "SELECT a.codigo,
               CONCAT(a.nombre, ' ', a.a_paterno, ' ', a.a_materno) AS nombre_completo,
               a.escuela,
               a.celular,
               u.correo
        FROM alumno a
        JOIN usuario u ON a.codigo = u.codigo_usuario
        WHERE a.codigo = '$CodigoUsuario'";

$Resultado = mysqli_query($cn, $Sql);

if (!$Resultado) {
    die('Error en la consulta: ' . mysqli_error($cn));
}

$Perfil = mysqli_fetch_assoc($Resultado);

if (!$Perfil) {
    die('No se encontró el perfil.');
}

// Consulta SQL para obtener las habilidades del alumno
$SqlHabilidades = "SELECT h.descripcion, dha.nivel
                   FROM detalle_habilidad_alumno dha
                   JOIN habilidad h ON dha.id_habilidad = h.id
                   WHERE dha.codigo_alumno = '$CodigoUsuario'";

$ResultadoHabilidades = mysqli_query($cn, $SqlHabilidades);

if (!$ResultadoHabilidades) {
    die('Error en la consulta de habilidades: ' . mysqli_error($cn));
}

$Habilidades = [];
while ($Habilidad = mysqli_fetch_assoc($ResultadoHabilidades)) {
    $Habilidades[] = $Habilidad;
}

// Consulta SQL para obtener los proyectos del alumno
$SqlProyectos = "SELECT p.nombre, p.descripcion, p.url, p.fecha_inicio, p.fecha_fin, dap.rol
                 FROM detalle_alumno_proyecto dap
                 JOIN proyecto p ON dap.id_proyecto = p.id
                 WHERE dap.codigo_alumno = '$CodigoUsuario'";

$ResultadoProyectos = mysqli_query($cn, $SqlProyectos);

if (!$ResultadoProyectos) {
    die('Error en la consulta de proyectos: ' . mysqli_error($cn));
}

$Proyectos = [];
while ($Proyecto = mysqli_fetch_assoc($ResultadoProyectos)) {
    $Proyectos[] = $Proyecto;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Talento</title>
    <link rel="icon" href="../img/Min_logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/EstiloPerfilTalento.css">
    <link rel="stylesheet" href="../css/DashboardAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>
<body>

    <?php include '../Componentes/NavBarEmpresa.php'; ?>

    <br><br><br><br><br>
    <div class="container perfil-talento">
        <div class="row text-center">
            <div class="col-md-12">
                <!-- Imagen de perfil -->
                <?php
                // Construir la ruta de la imagen de perfil
                $ImagenPerfil = '../FotoPerfil/Alumnos/' . htmlspecialchars($Perfil['codigo']) . '.jpg'; // Puedes ajustar la extensión si es .png u otra
                if (!file_exists($ImagenPerfil)) {
                    $ImagenPerfil = '../img/path/to/default_image.png'; // Ruta de una imagen por defecto si no se encuentra la imagen del perfil
                }
                ?>
                <img src="<?php echo htmlspecialchars($ImagenPerfil); ?>" alt="Imagen de Perfil" class="img-fluid perfil-imagen">
            </div>
        </div>
        <div class="row text-center mt-4">
            <div class="col-md-12">
                <h2><?php echo htmlspecialchars($Perfil['nombre_completo']); ?></h2>
                <p class="text-muted">
                    <?php echo htmlspecialchars($Perfil['codigo']); ?> | <?php echo htmlspecialchars($Perfil['escuela']); ?>
                </p>
            </div>
        </div>
        <!-- Nueva fila con información de contacto -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h6>Contacto</h6>
                <p class="contact-info"><strong>Celular:</strong> <?php echo htmlspecialchars($Perfil['celular']); ?></p>
                <p class="contact-info"><strong>Correo:</strong> <?php echo htmlspecialchars($Perfil['correo']); ?></p>
            </div>
            <div class="col-md-6 text-center">
                <!-- Imagen fija como logo o sello -->
                <img src="../img/LogoFaus.png" alt="Sello" class="img-fluid" style="max-width: 380px; height: auto;">
            </div>
        </div>
        <!-- Fila con habilidades -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h6>Habilidades</h6>
                <table class="table habilidades-tabla">
                    <thead>
                        <tr>
                            <th>Habilidad</th>
                            <th>Nivel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($Habilidades)) : ?>
                            <tr>
                                <td colspan="2">No se han registrado habilidades para este alumno.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($Habilidades as $Habilidad) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($Habilidad['descripcion']); ?></td>
                                    <td><?php echo htmlspecialchars($Habilidad['nivel']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Fila con proyectos -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h6>Proyectos</h6>
                <table class="table proyectos-tabla">
                    <thead>
                        <tr>
                            <th>Nombre(URL)</th>
                            <th>Descripción</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($Proyectos)) : ?>
                            <tr>
                                <td colspan="5">No se han registrado proyectos para este alumno.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($Proyectos as $Proyecto) : ?>
                                <tr>
                                    <td><a href="<?php echo htmlspecialchars($Proyecto['url']); ?>" target="_blank"><?php echo htmlspecialchars($Proyecto['nombre']); ?></a></td>
                                    <td class="descripcion-columna"><?php echo htmlspecialchars($Proyecto['descripcion']); ?></td>
                                    <td><?php echo htmlspecialchars($Proyecto['fecha_inicio']); ?></td>
                                    <td><?php echo htmlspecialchars($Proyecto['fecha_fin']); ?></td>
                                    <td><?php echo htmlspecialchars($Proyecto['rol']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col text-center">
                <a class="btn btn-secondary" href="VerTalentos.php">Regresar</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
