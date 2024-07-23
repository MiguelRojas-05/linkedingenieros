<?php
include '../Conexion.php';
include '../Auth/Admin.php';

// Número de registros por página
$records_per_page = 10;

// Obtén el número de página actual de la URL, por defecto es la página 1
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
} else {
    $current_page = 1;
}

// Calcula la posición inicial del primer registro de la página actual
$start_from = ($current_page - 1) * $records_per_page;

// Consulta para obtener el número total de registros
$total_records_query = "SELECT COUNT(*) FROM auditoria";
$result = mysqli_query($cn, $total_records_query);
$total_records = mysqli_fetch_array($result)[0];

// Calcula el número total de páginas
$total_pages = ceil($total_records / $records_per_page);

// Consulta para obtener los registros de la página actual
$query = "SELECT *, DATE_FORMAT(fecha, '%d-%m-%Y %H:%i') AS fecha_formateada 
          FROM auditoria 
          ORDER BY fecha DESC
          LIMIT $start_from, $records_per_page";
$result = mysqli_query($cn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Principal</title>
    <link rel="icon" href="../img/Min_logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/DashboardAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>
    <?php include '../Componentes/NavBarAdmin.php'; ?>

    <div class="container" style="margin-top: 100px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-10">
                <table class="table table-sm table-hover">
                    <thead class="table-active">
                        <tr>
                            <td>Tabla</td>
                            <td>Acción</td>
                            <td>Usuario</td>
                            <td>Detalles</td>
                            <td>Fecha de acción</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($r = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $r['tabla']; ?></td>
                            <td><?php echo $r['accion']; ?></td>
                            <td><?php echo $r['usuario']; ?></td>
                            <td><?php echo $r['detalles']; ?></td>
                            <td><?php echo $r['fecha_formateada']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                
                <!-- Paginación -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="ElQueTodoLoVe.php?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if($i == $current_page) echo 'active'; ?>">
                                <a class="page-link" href="ElQueTodoLoVe.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="ElQueTodoLoVe.php?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
