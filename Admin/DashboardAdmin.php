<?php
include '../Conexion.php';
include '../Auth/Admin.php';

// Consulta para obtener la cantidad de usuarios por tipo
$query = "SELECT tu.nombre_tipo, COUNT(*) AS cantidad
          FROM usuario u
          JOIN tipo_usuario tu ON u.id_tipo_usuario = tu.id
          GROUP BY tu.nombre_tipo";
$resultado = mysqli_query($cn, $query);

$tipos = [];
$cantidades = [];

while ($row = mysqli_fetch_assoc($resultado)) {
    $tipos[] = $row['nombre_tipo'];
    $cantidades[] = $row['cantidad'];
}

// Consulta para la cantidad de usuarios totales registrados
$CantUsuarios = "SELECT COUNT(*) AS total_usuarios FROM usuario";
$x = mysqli_query($cn, $CantUsuarios);
$total_usuarios = mysqli_fetch_assoc($x)['total_usuarios'];

// Consulta para la cantidad de propuestas laborales publicadas
$CantPropuestas = "SELECT COUNT(*) AS total_propuestas FROM propuesta_laboral";
$y = mysqli_query($cn, $CantPropuestas);
$total_propuestas = mysqli_fetch_assoc($y)['total_propuestas'];

// Consulta para la cantidad de proyectos publicados
$CantProyectos = "SELECT COUNT(*) AS total_proyectos FROM proyecto";
$z = mysqli_query($cn, $CantProyectos);
$total_proyectos = mysqli_fetch_assoc($z)['total_proyectos'];
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
    <?php
    include '../Componentes/NavBarAdmin.php';
    ?>

    <div class="container-fluid" style="margin-top: 10%;">
        <div class="row d-flex justify-content-center">
            <div class="col col-4">
                <canvas id="userPieChart" width="400" height="200"></canvas>
            </div>
            <div class="col col-5 d-flex">
                <table class="table table-sm table-hover">
                    <tr>
                        <td><h5>Cantidad de usuarios registrados:</h5></td>
                        <td>
                            <span class="fs-1">
                            <?php echo $total_usuarios; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><h5>Cantidad de propuestas laborales publicadas:</h5></td>
                        <td>
                            <span class="fs-1">
                            <?php echo $total_propuestas; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><h5>Cantidad de proyectos publicados:</h5></td>
                        <td>
                            <span class="fs-1">
                            <?php echo $total_proyectos; ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('userPieChart').getContext('2d');
            var userPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($tipos); ?>, // Tipos de usuarios
                    datasets: [{
                        label: 'Cantidad de Usuarios',
                        data: <?php echo json_encode($cantidades); ?>, // Cantidades para cada tipo de usuario
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgb(192 192 192)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgb(130 130 130)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
