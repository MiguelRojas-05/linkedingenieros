<?php
include("../Auth/Docente.php");
include("../Conexion.php");

// Definir la cantidad de registros por página
$registrosPorPagina = 10;

// Obtener el número de página actual, si no está definido se establece en 1
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina = ($pagina < 1) ? 1 : $pagina;

// Calcular el offset de la consulta SQL
$offset = ($pagina - 1) * $registrosPorPagina;

// Obtener habilidades y escuelas únicas
$sql_habilidades = "SELECT DISTINCT h.descripcion FROM habilidad h";
$habilidades_result = mysqli_query($cn, $sql_habilidades);
$habilidades = [];
while ($row = mysqli_fetch_assoc($habilidades_result)) {
    $habilidades[] = $row['descripcion'];
}

$sql_escuelas = "SELECT DISTINCT a.escuela FROM alumno a";
$escuelas_result = mysqli_query($cn, $sql_escuelas);
$escuelas = [];
while ($row = mysqli_fetch_assoc($escuelas_result)) {
    $escuelas[] = $row['escuela'];
}

// Obtener los parámetros de búsqueda del formulario
$Nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($cn, $_POST['nombre']) : '';
$Habilidad = isset($_POST['habilidad']) ? mysqli_real_escape_string($cn, $_POST['habilidad']) : '';
$Escuela = isset($_POST['escuela']) ? mysqli_real_escape_string($cn, $_POST['escuela']) : '';

// Inicializar consulta SQL base
$Sql = "SELECT DISTINCT a.codigo, 
               CONCAT(a.nombre, ' ', a.a_paterno, ' ', a.a_materno) AS nombre_completo,
               a.escuela
        FROM alumno a
        LEFT JOIN detalle_habilidad_alumno dha ON a.codigo = dha.codigo_alumno
        LEFT JOIN habilidad h ON dha.id_habilidad = h.id
        WHERE 1=1";

// Añadir condiciones según los campos de búsqueda
if (!empty($Nombre)) {
    $Sql .= " AND CONCAT(a.nombre, ' ', a.a_paterno, ' ', a.a_materno) LIKE '%$Nombre%'";
}
if (!empty($Habilidad)) {
    $Sql .= " AND h.descripcion = '$Habilidad'";
}
if (!empty($Escuela)) {
    $Sql .= " AND a.escuela = '$Escuela'";
}

// Añadir limitación y offset para paginación
$Sql .= " LIMIT $registrosPorPagina OFFSET $offset";

// Ejecutar la consulta
$Usuarios = mysqli_query($cn, $Sql);

if (!$Usuarios) {
    die('Error en la consulta: ' . mysqli_error($cn));
}

// Contar el total de registros
$sql_total = "SELECT COUNT(DISTINCT a.codigo) AS total
              FROM alumno a
              LEFT JOIN detalle_habilidad_alumno dha ON a.codigo = dha.codigo_alumno
              LEFT JOIN habilidad h ON dha.id_habilidad = h.id
              WHERE 1=1";

if (!empty($Nombre)) {
    $sql_total .= " AND CONCAT(a.nombre, ' ', a.a_paterno, ' ', a.a_materno) LIKE '%$Nombre%'";
}
if (!empty($Habilidad)) {
    $sql_total .= " AND h.descripcion = '$Habilidad'";
}
if (!empty($Escuela)) {
    $sql_total .= " AND a.escuela = '$Escuela'";
}

$total_result = mysqli_query($cn, $sql_total);
$total_row = mysqli_fetch_assoc($total_result);
$totalRegistros = $total_row['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Talentos</title>
    <link rel="icon" href="../img/Min_logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/EstiloVerTalentos.css">
    <link rel="stylesheet" href="../css/DashboardAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>
<body>

    <?php
    include '../Componentes/NavBarDocente.php';
    ?>

    <br><br><br><br><br>
    <div class="ContainerTalentos">
        <h1>Talentos</h1>

        <!-- Formulario de búsqueda -->
        <div class="search-form">
            <form method="post" action="">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input autocomplete="off" class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($Nombre); ?>">
                    </div>
                    <div class="col-md-4">
                        <select name="habilidad" class="form-select">
                            <option value="">Todas las habilidades</option>
                            <?php foreach ($habilidades as $habilidad) : ?>
                                <option value="<?php echo htmlspecialchars($habilidad); ?>" <?php echo ($habilidad == $Habilidad) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($habilidad); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="escuela" class="form-select">
                            <option value="">Todas las escuelas</option>
                            <?php foreach ($escuelas as $escuela) : ?>
                                <option value="<?php echo htmlspecialchars($escuela); ?>" <?php echo ($escuela == $Escuela) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($escuela); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col text-center">
                        <input type="submit" class="btn btn-primary" value="Filtrar">
                    </div>
                </div>
            </form>
        </div>

        <div class="user-table">
            <?php
            // Verificar si se encontraron usuarios
            if (mysqli_num_rows($Usuarios) > 0) {
                while ($R = mysqli_fetch_assoc($Usuarios)) {
                    $ImagenPerfil = '../FotoPerfil/Alumnos/' . htmlspecialchars($R['codigo']) . '.jpg'; // Ruta de la imagen de perfil
                    $CodigoUsuario = htmlspecialchars($R['codigo']);
                    echo "<div class='user-row'>";
                    echo "<div class='user-image'><img src='" . htmlspecialchars($ImagenPerfil) . "' alt='Perfil'></div>";
                    echo "<div class='user-info'>";
                    echo "<p class='user-name'>" . htmlspecialchars($R['nombre_completo']) . "</p>";
                    echo "<p class='user-details'>Código: " . htmlspecialchars($R['codigo']);
                    echo " | Escuela: " . htmlspecialchars($R['escuela']);
                    echo "</p>";
                    echo "</div>";
                    echo "<div class='user-action'>";
                    echo "<a href='PerfilTalento.php?codigo=" . $CodigoUsuario . "' class='btn btn-primary btn-sm'>Ver Perfil</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No se encontraron resultados.</p>";
            }
            ?>
        </div>

        <!-- Paginación -->
        <div class="pagination d-flex justify-content-center ">
            <?php if ($totalPaginas > 1) : ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if ($pagina > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                            <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($pagina < $totalPaginas) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Siguiente">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>