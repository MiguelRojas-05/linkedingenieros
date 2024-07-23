<?php

include '../Auth/Alumno.php';
include '../Conexion.php';

$c = $_SESSION["codigo_usuario"];
$query = "SELECT p.id, p.nombre, dap.rol
        FROM proyecto p
        JOIN detalle_alumno_proyecto dap ON p.id = dap.id_proyecto
        WHERE dap.codigo_alumno = '$c';
        ";
$date = mysqli_query($cn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno</title>
    <link rel="stylesheet" href="../css/EstiloIndexAlumno.css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

    <?php
    include '../Componentes/NavBarAlumno.php';
    ?>

    <div class="container" style="margin-top: 120px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-6">
                <table class="table table-sm text-center table-hover">
                    <thead class="table-active">
                        <tr>
                            <td>
                                Nombre del proyecto
                            </td>
                            <td>
                                Rol
                            </td>
                            <td>
                                Opciones
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($r = mysqli_fetch_array($date)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $r["nombre"] ?>
                                </td>
                                <td>
                                <?php echo $r["rol"] ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="./AlumnoDetalleProyecto.php?id=<?php echo $r['id'] ?>"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-sm btn-danger" href="./AlumnoProcesoBorrarProyecto.php?id=<?php echo $r['id'] ?>"><i class="bi bi-trash3"></i></a>
                                    <a class="btn btn-sm btn-primary" href="./AlumnoEditarProyecto.php?id=<?php echo $r['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-sm btn-success" href="AgregarMiembrosProyecto.php?id=<?php echo $r['id'] ?>"><i class="bi bi-person-plus-fill"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>