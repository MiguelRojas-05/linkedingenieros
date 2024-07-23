<?php

include '../Auth/Alumno.php';
include '../Conexion.php';
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

    $id_proyecto = $_GET["id"];
    $query = "SELECT * FROM proyecto p WHERE p.id = '$id_proyecto' ";
    $date = mysqli_query($cn, $query);
    $r = mysqli_fetch_assoc($date);
    ?>

    <div class="container" style="margin-top: 120px;">
        <div class="row d-flex justify-content-center">
            <div class="col col-6">
                <form action="./AlumnoProcesoEditarProyecto.php" method="post">
                    <input type="text" name="id_pro" value="<?php echo $id_proyecto; ?>" hidden>
                    <table class="table table-sm table-hover">
                        <tr>
                            <td class="fw-bold">Nombre del proyecto</td>
                            <td><input class="form-control" type="text" name="nombre" value="<?php echo htmlspecialchars($r['nombre'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" colspan="2">Descripcion</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea name="descripcion" class="form-control" style="height: 180px;">
                                <?php echo $r["descripcion"]; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">
                                Url
                            </td>
                            <td colspan="2">
                                <input type="text" class="form-control" name="url" value="<?php echo $r["url"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Fecha de inicio</td>
                            <td>
                                <input class="form-control" type="date" name="fecha_inicio" value="<?php echo $r["fecha_inicio"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Fecha de finalización</td>
                            <td>
                            <input type="date" name="fecha_fin" class="form-control" value="<?php echo $r["fecha_fin"]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <input type="submit" class="bt btn-sm btn-primary" value="Editar">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a class="btn btn-sm btn-secondary" href="./MisProyectos.php">Atrás</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>