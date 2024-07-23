<?php
include '../Conexion.php';
include '../Auth/Admin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Docentes</title>
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
                <form class="container" action="Docentes.php" method="post">
                    <div class="row d-flex justify-content-center">
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
                            <td><strong>Nombre</strong></td>
                            <td><strong>Opciones</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Número de registros por página
                        $CantidadRegistroPorPagina = 6;

                        // Verifica si se ha enviado el formulario de búsqueda
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $nombre = $_POST['nombre'];
                            $sql = "SELECT d.codigo, d.correo, CONCAT(d.nombre,' ',d.a_paterno,' ',d.a_materno) AS nombre_completo 
                                    FROM docente d 
                                    WHERE d.nombre LIKE '%$nombre%' ";
                        } else {
                            $sql = "SELECT d.codigo, d.correo, CONCAT(d.nombre,' ',d.a_paterno,' ',d.a_materno) AS nombre_completo 
                                    FROM docente d ";
                        }

                        // Realiza la consulta para obtener el número total de registros
                        $prep = mysqli_query($cn, $sql);
                        $NumFilas = mysqli_num_rows($prep);

                        // Calcular el número de páginas
                        $NumeroPaginas = ceil($NumFilas / $CantidadRegistroPorPagina);

                        // Verificar el límite de inicio de la página actual
                        $Limite3 = isset($_GET["limi"]) ? $_GET["limi"] : 0;

                        // Agregar la cláusula LIMIT a la consulta
                        $sql .= " LIMIT $Limite3, $CantidadRegistroPorPagina";
                        $resultado = mysqli_query($cn, $sql);

                        // Mostrar los registros
                        while ($row = $resultado->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $row['codigo']; ?></td>
                                <td><?php echo $row['nombre_completo']; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="./DetalleDocentes.php?codigo=<?php echo $row['codigo'] ?>">Ver más
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="container">
                    <div class="row d-flex justify-content-around">
                        <div class="col text-center">
                            <?php
                            // Crear enlaces de paginación
                            for ($i = 0; $i < $NumeroPaginas; $i++) {
                                $Limite4 = $i * $CantidadRegistroPorPagina;
                                echo "<a class='mx-1 btn btn-sm btn-outline-warning' target='_parent' href='Docentes.php?limi=$Limite4'>" . ($i + 1) . "</a>";
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
