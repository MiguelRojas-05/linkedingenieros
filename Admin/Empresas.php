<?php
include '../Conexion.php';
include '../Auth/Admin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Empresas</title>
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
            <div class="col col-8">
                <form class="container" action="Empresas.php" method="post">
                    <div class="row d-flex justify-content-center">
                        <div class="col col-4 text-center">
                            <select name="sector" class="form-select">
                                <option value="TS">Todos los sectores</option>
                                <option value="Agricultura y Pesca">Agricultura y Pesca</option>
                                <option value="Minería">Minería</option>
                                <option value="Manufactura">Manufactura</option>
                                <option value="Construcción">Construcción</option>
                                <option value="Comercio y Retail">Comercio y Retail</option>
                                <option value="Transporte y Logística">Transporte y Logística</option>
                                <option value="Turismo y Hotelería">Turismo y Hotelería</option>
                                <option value="Finanzas y Seguros">Finanzas y Seguros</option>
                                <option value="Educación">Educación</option>
                                <option value="Salud">Salud</option>
                                <option value="Tecnología y Telecomunicaciones">Tecnología y Telecomunicaciones</option>
                                <option value="Energía y Servicios Públicos">Energía y Servicios Públicos</option>
                                <option value="Servicios Profesionales">Servicios Profesionales</option>
                                <option value="Alimentos y Bebidas">Alimentos y Bebidas</option>
                                <option value="Inmobiliario">Inmobiliario</option>
                            </select>
                        </div>
                        <div class="col col-4 text-center">
                            <input autocomplete="off" class="form-control" type="text" name="nombre" placeholder="Busqueda por nombre">
                        </div>
                        <div class="row d-flex justify-content-center my-2">
                            <div class="col text-center">
                                <input type="submit" class="btn btn-sm text-white" style="background-color: var(--azul);" value="Filtrar">
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-sm text-center table-hover">
                    <thead class="table-active table-primary">
                        <tr>
                            <td><strong>Código</strong></td>
                            <td><strong>Razón social</strong></td>
                            <td><strong>Sector</strong></td>
                            <td><strong>Opciones</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                            $Limite3 = isset($_GET["limi"]) ? $_GET["limi"] : 0;
                            $sector = isset($_GET['sector']) ? $_GET['sector'] : 'TS';
                            $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';

                            $sql = "SELECT * FROM empresa e ";

                            if ($sector != 'TS') {
                                $sql .= " WHERE e.sector = '$sector' ";
                                if (!empty($nombre)) {
                                    $sql .= "AND e.razon_social LIKE '%$nombre%' ";
                                }
                            } else {
                                if (!empty($nombre)) {
                                    $sql .= " WHERE e.razon_social LIKE '%$nombre%' ";
                                }
                            }

                            $prep = mysqli_query($cn, $sql);
                            $NumFilas = mysqli_num_rows($prep);
                            if ($NumFilas > 6) {
                                $sql .= " LIMIT $Limite3,6";
                            }
                            $resultado = mysqli_query($cn, $sql);
                            while ($row = $resultado->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $row['codigo']; ?></td>
                                    <td><?php echo $row['razon_social']; ?></td>
                                    <td><?php echo $row['sector']; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="./DetalleEmpresas.php?codigo=<?php echo $row['codigo'] ?>">Ver más
                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $sector = $_POST['sector'];
                            $nombre = $_POST['nombre'];
                            $sql = "SELECT * FROM empresa e ";

                            if ($sector != 'TS') {
                                $sql .= " WHERE e.sector = '$sector' ";
                                if (!empty($nombre)) {
                                    $sql .= "AND e.razon_social LIKE '%$nombre%' ";
                                }
                            } else {
                                if (!empty($nombre)) {
                                    $sql .= " WHERE e.razon_social LIKE '%$nombre%' ";
                                }
                            }

                            $prep = mysqli_query($cn, $sql);
                            $NumFilas = mysqli_num_rows($prep);

                            $sql .= " LIMIT 0,6";
                            $resultado = mysqli_query($cn, $sql);
                            while ($row = $resultado->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row['codigo']; ?></td>
                                    <td><?php echo $row['razon_social']; ?></td>
                                    <td><?php echo $row['sector']; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="./DetalleEmpresas.php?codigo=<?php echo $row['codigo'] ?>">Ver más
                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="container">
                    <div class="row d-flex justify-content-around">
                        <div class="col text-center">
                            <?php
                            $CantidadRegistroPorPagina = 6;
                            $NumeroPaginas = ceil($NumFilas / $CantidadRegistroPorPagina);

                            for ($i = 0; $i < $NumeroPaginas; $i++) {
                                $Limite4 = $i * $CantidadRegistroPorPagina;
                                echo "<a class='mx-1 btn btn-sm btn-outline-warning' target='_parent' href='Empresas.php?limi=$Limite4&sector=$sector&nombre=$nombre'>" . ($i + 1) . "</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
