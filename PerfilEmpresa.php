<?php
include './Auth/Perfil.php';
include('./Conexion.php');

// Extraer el código de la empresa desde la URL
$CodigoEmpresa = isset($_GET['codigo']) ? mysqli_real_escape_string($cn, $_GET['codigo']) : '';

// Consulta SQL para obtener los detalles del perfil de la empresa
$Sql = "SELECT e.codigo,
               e.ruc,
               e.razon_social AS nombre_empresa,
               e.sector,
               e.celular,
               e.correo_contacto,
               e.descripcion
        FROM empresa e
        WHERE e.codigo = '$CodigoEmpresa'";

$Resultado = mysqli_query($cn, $Sql);

if (!$Resultado) {
    die('Error en la consulta: ' . mysqli_error($cn));
}

$Perfil = mysqli_fetch_assoc($Resultado);

if (!$Perfil) {
    die('No se encontró el perfil.');
}

// Consulta SQL para obtener las propuestas laborales de la empresa
$SqlPropuestas = "SELECT p.nombre AS nombre_propuesta, 
                          p.fecha_publi AS fecha_publicacion
                  FROM propuesta_laboral p
                  WHERE p.codigo_empresa = '$CodigoEmpresa'";

$ResultadoPropuestas = mysqli_query($cn, $SqlPropuestas);

if (!$ResultadoPropuestas) {
    die('Error en la consulta de propuestas: ' . mysqli_error($cn));
}

$Propuestas = [];
while ($Propuesta = mysqli_fetch_assoc($ResultadoPropuestas)) {
    $Propuestas[] = $Propuesta;
}

// Ruta del logo de la empresa
$LogoEmpresa = './FotoPerfil/Empresas/' . htmlspecialchars($Perfil['codigo']) . '.jpg'; // Ajusta la extensión si es necesario
if (!file_exists($LogoEmpresa)) {
    $LogoEmpresa = '../img/path/to/default_logo.png'; // Ruta de una imagen por defecto si no se encuentra el logo
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Empresa</title>
    <link rel="icon" href="./img/Min_logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/EstiloPerfilEmpresa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>
<body>
    <div class="container perfil-empresa">
        <!-- Fila con la imagen de perfil -->
        <div class="row text-center">
            <div class="col-md-12">
                <img src="<?php echo htmlspecialchars($LogoEmpresa); ?>" alt="Logo de Empresa" class="img-fluid perfil-imagen">
            </div>
        </div>
        <!-- Fila con el nombre de la empresa y el código/sector -->
        <div class="row text-center mt-4">
            <div class="col-md-12">
                <h2><?php echo htmlspecialchars($Perfil['nombre_empresa']); ?></h2>
                <p class="text-muted">
                    <?php echo htmlspecialchars($Perfil['codigo']); ?> | <?php echo htmlspecialchars($Perfil['sector']); ?>
                </p>
            </div>
        </div>
        <!-- Fila con la información de contacto -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h6>Contacto</h6>
                <p class="contact-info"><strong>Celular:</strong> <?php echo htmlspecialchars($Perfil['celular']); ?></p>
                <p class="contact-info"><strong>Correo:</strong> <?php echo htmlspecialchars($Perfil['correo_contacto']); ?></p>
            </div>
            <div class="col-md-6 text-center">
                <p class="text-muted"><strong>RUC:</strong> <?php echo htmlspecialchars($Perfil['ruc']); ?></p>
            </div>
        </div>
        <!-- Fila con la descripción de la empresa -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h6>Descripción</h6>
                <p><?php echo htmlspecialchars($Perfil['descripcion']); ?></p>
            </div>
        </div>
        <!-- Fila con propuestas laborales -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h6>Propuestas Laborales</h6>
                <table class="table propuestas-tabla">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de Publicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($Propuestas)) : ?>
                            <tr>
                                <td colspan="2">No se han registrado propuestas laborales para esta empresa.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($Propuestas as $Propuesta) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($Propuesta['nombre_propuesta']); ?></td>
                                    <td><?php echo htmlspecialchars($Propuesta['fecha_publicacion']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
