<?php
ob_start(); 
include '../Conexion.php';
include '../Auth/Admin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Propuestas</title>
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
                <form class="container" action="Propuestas.php" method="post">
                    <div class="row d-flex justify-content-center">
                        <div class="col col-4 text-center">
                            <select name="empresa" class="form-select">
                                <option value="TE">Todas las empresas</option>
                                <?php
                                $q = "SELECT e.razon_social FROM empresa e";
                                $r = mysqli_query($cn, $q);
                                while ($row = mysqli_fetch_array($r)) {
                                ?>
                                    <option value="<?php echo $row['razon_social'] ?>"><?php echo $row['razon_social'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col col-4 text-center">
                            <select name="estado_pro" class="form-select">
                                <option value="TS">Todos los estados</option>
                                <option value="1">Activa</option>
                                <option value="2">Inactiva</option>
                                <option value="3">Inhabilitada</option>
                                <option value="4">Borrada</option>
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
                            <td><strong>Id</strong></td>
                            <td><strong>Nombre</strong></td>
                            <td><strong>Empresa</strong></td>
                            <td><strong>Opciones</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Número de registros por página
                        $CantidadRegistroPorPagina = 6;

                        // Verificar si se ha enviado el formulario de búsqueda
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $empresa = $_POST['empresa'];
                            $estado = $_POST['estado_pro'];
                            $nombre = $_POST['nombre'];
                            $Limite3 = 0; // Inicio en la primera página

                            $sql = "SELECT p.id, p.nombre, p.descripcion, p.fecha_publi, p.fecha_limite, e.razon_social AS empresa, ep.descripcion AS estado 
                                    FROM propuesta_laboral p 
                                    JOIN empresa e ON p.codigo_empresa = e.codigo 
                                    JOIN estado_propuesta ep ON p.id_estado_propuesta = ep.id 
                                    WHERE 1=1";

                            if ($empresa != 'TE') {
                                $sql .= " AND (e.razon_social = '$empresa') ";
                            }
                            if ($estado != 'TS') {
                                $sql .= " AND (ep.id = '$estado') ";
                            }
                            if (!empty($nombre)) {
                                $sql .= " AND p.nombre LIKE '%$nombre%'";
                            }

                            // Guardar la consulta para usarla sin LIMIT
                            $sqlCount = $sql;

                            // Redirigir a la misma página con los parámetros GET
                            header("Location: Propuestas.php?limi=$Limite3&empresa=$empresa&estado_pro=$estado&nombre=$nombre");
                            exit();
                        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                            $Limite3 = isset($_GET["limi"]) ? $_GET["limi"] : 0;
                            $empresa = isset($_GET['empresa']) ? $_GET['empresa'] : 'TE';
                            $estado = isset($_GET['estado_pro']) ? $_GET['estado_pro'] : 'TS';
                            $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';

                            $sql = "SELECT p.id, p.nombre, p.descripcion, p.fecha_publi, p.fecha_limite, e.razon_social AS empresa, ep.descripcion AS estado 
                                    FROM propuesta_laboral p 
                                    JOIN empresa e ON p.codigo_empresa = e.codigo 
                                    JOIN estado_propuesta ep ON p.id_estado_propuesta = ep.id 
                                    WHERE 1=1";

                            if ($empresa != 'TE') {
                                $sql .= " AND (e.razon_social = '$empresa') ";
                            }
                            if ($estado != 'TS') {
                                $sql .= " AND (ep.id = '$estado') ";
                            }
                            if (!empty($nombre)) {
                                $sql .= " AND p.nombre LIKE '%$nombre%'";
                            }

                            // Guardar la consulta para usarla sin LIMIT
                            $sqlCount = $sql;
                        }

                        // Realiza la consulta para obtener el número total de registros
                        $prep = mysqli_query($cn, $sqlCount);
                        $NumFilas = mysqli_num_rows($prep);

                        // Calcular el número de páginas
                        $NumeroPaginas = ceil($NumFilas / $CantidadRegistroPorPagina);

                        // Agregar la cláusula LIMIT a la consulta
                        $sql .= " LIMIT $Limite3, $CantidadRegistroPorPagina";
                        $resultado = mysqli_query($cn, $sql);

                        // Mostrar los registros
                        while ($row = $resultado->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['empresa']; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="./DetallePropuestas.php?id=<?php echo $row['id'] ?>">Ver más
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
                                // Conservar los filtros aplicados en los enlaces de paginación
                                echo "<a class='mx-1 btn btn-sm btn-outline-warning' target='_parent' href='Propuestas.php?limi=$Limite4&empresa=$empresa&estado_pro=$estado&nombre=$nombre'>" . ($i + 1) . "</a>";
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