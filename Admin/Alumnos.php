<?php
include '../Auth/Admin.php';
include '../Conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Alumnos</title>
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
                <form class="container" action="Alumnos.php" method="post">
                    <div class="row d-flex justify-content-center">
                        <div class="col col-4 text-center">
                            <select name="escuela" class="form-select">
                                <option value="TE">Todas las escuelas</option>
                                <option value="Ingeniería de Sistemas">Ing. Sistemas</option>
                                <option value="Ingeniería de Informática">Ing. Informática</option>
                                <option value="Ingeniería Industrial">Ing. Industrial</option>
                                <option value="Ingeniería Electrónica">Ing. Electrónica</option>
                            </select>
                        </div>
                        <div class="col col-4 text-center">
                            <select name="habilidad" class="form-select">
                                <option value="TH">Todas las habilidades</option>
                                <option value="Desarrollo Software">Desarrollo Software</option>
                                <option value="Gestión Proyectos">Gestión Proyectos</option>
                                <option value="Análisis de Datos">Análisis de Datos</option>
                                <option value="Redes y Seguridad Inf.">Redes y Seguridad Inf.</option>
                                <option value="Diseño de Circuitos Elec.">Diseño de Circuitos Elec.</option>
                                <option value="Innovación y Creatividad">Innovación y Creatividad</option>
                                <option value="Trabajo en Equipo">Trabajo en Equipo</option>
                                <option value="0">Sin habilidades</option>
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
                            <td><strong>Nombre</strong></td>
                            <td><strong>Escuela</strong></td>
                            <td><strong>Opciones</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                            $Limite3 = isset($_GET["limi"]) ? $_GET["limi"] : 0;
                            $escuela = isset($_GET['escuela']) ? $_GET['escuela'] : 'TE';
                            $habilidad = isset($_GET['habilidad']) ? $_GET['habilidad'] : 'TH';
                            $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';

                            $sql = "SELECT a.codigo, a.nombre, a.a_paterno, a.a_materno, a.escuela, a.celular 
                                    FROM alumno a 
                                    LEFT JOIN detalle_habilidad_alumno dha ON a.codigo = dha.codigo_alumno 
                                    LEFT JOIN habilidad h ON dha.id_habilidad = h.id ";

                            $sql_conditions = [];

                            if ($habilidad != 'TH') {
                                $sql_conditions[] = "h.descripcion = '$habilidad'";
                            }
                            if ($escuela != 'TE') {
                                $sql_conditions[] = "a.escuela = '$escuela'";
                            }
                            if (!empty($nombre)) {
                                $sql_conditions[] = "a.nombre LIKE '%$nombre%'";
                            }

                            if (count($sql_conditions) > 0) {
                                $sql .= " WHERE " . implode(" AND ", $sql_conditions);
                            }

                            $sql .= " GROUP BY a.codigo, a.nombre, a.a_paterno, a.a_materno, a.escuela, a.celular ";

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
                                    <td><?php echo $row['nombre'] . " " . $row['a_paterno'] . " " . $row['a_materno']; ?></td>
                                    <td><?php echo $row['escuela']; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="./DetalleAlumnos.php?codigo=<?php echo $row['codigo'] ?>">Ver más
                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $escuela = $_POST['escuela'];
                            $habilidad = $_POST['habilidad'];
                            $nombre = $_POST['nombre'];

                            $sql = "SELECT a.codigo, a.nombre, a.a_paterno, a.a_materno, a.escuela, a.celular 
                                    FROM alumno a 
                                    LEFT JOIN detalle_habilidad_alumno dha ON a.codigo = dha.codigo_alumno 
                                    LEFT JOIN habilidad h ON dha.id_habilidad = h.id ";

                            $sql_conditions = [];

                            if ($habilidad != 'TH') {
                                $sql_conditions[] = "h.descripcion = '$habilidad'";
                            }
                            if ($escuela != 'TE') {
                                $sql_conditions[] = "a.escuela = '$escuela'";
                            }
                            if (!empty($nombre)) {
                                $sql_conditions[] = "a.nombre LIKE '%$nombre%'";
                            }

                            if (count($sql_conditions) > 0) {
                                $sql .= " WHERE " . implode(" AND ", $sql_conditions);
                            }

                            $sql .= " GROUP BY a.codigo, a.nombre, a.a_paterno, a.a_materno, a.escuela, a.celular ";

                            $prep = mysqli_query($cn, $sql);
                            $NumFilas = mysqli_num_rows($prep);


                            $sql .= " LIMIT 0,6";

                            $resultado = mysqli_query($cn, $sql);

                            while ($row = $resultado->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row['codigo']; ?></td>
                                    <td><?php echo $row['nombre'] . " " . $row['a_paterno'] . " " . $row['a_materno']; ?></td>
                                    <td><?php echo $row['escuela']; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="./DetalleAlumnos.php?codigo=<?php echo $row['codigo'] ?>">Ver más
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

                                echo "<a class='mx-1 btn btn-sm btn-outline-warning' target='_parent' href='Alumnos.php?limi=$Limite4&escuela=$escuela&habilidad=$habilidad&nombre=$nombre'>" . ($i + 1) . "</a>";
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