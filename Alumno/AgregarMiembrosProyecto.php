<?php

include '../Auth/Alumno.php';
include '../Conexion.php';
$IdPro = $_GET["id"];
if (isset($_GET["codigo"])  && isset($_GET["rol"])) {
    $CodAgre = $_GET["codigo"];
    $Rol = $_GET["rol"];

    $query = "INSERT INTO detalle_alumno_proyecto (codigo_alumno, id_proyecto, rol) VALUES ('$CodAgre', '$IdPro', '$Rol');";
    mysqli_query($cn, $query);
    Header('Location: MisProyectos.php');
    exit();
}
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
            <div class="col col-4">
                <form action="AgregarMiembrosProyecto.php" method="get">
                    <fieldset class="fs-4 fw-bold">Agregar miembro del proyecto por código</fieldset>
                    <p>
                        Debe insertar el codigo del nuevo miembro del proyecto que desea agregar y también su rol dentro del proyecto.
                        <br>
                        El rol debe ser descrito de forma breve, por ejemplo "diseñador ui" "asistente"
                    </p>
                    <input type="text" name="id" hidden value="<?php echo $IdPro; ?>">
                    <input autocomplete="off" class="form-control my-2" name="codigo" type="text" placeholder="Inserte código">
                    <input autocomplete="off" class="form-control my-2" type="text" name="rol" placeholder="Inserte rol">
                    <div class="row text-center">
                        <input class="btn btn-sm btn-primary" type="submit" value="Agregar miembro">
                    </div>
                </form>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-4">
            <div class="col col-8">
                <table class="table table-hover table-sm">
                    <thead class="table-active">
                        <tr>
                            <td>
                                Código
                            </td>
                            <td>
                                Nombres
                            </td>
                            <td>
                                Rol
                            </td>
                            <td>
                                Escuela
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $VerMiembros = "SELECT a.codigo, a.nombre, a.a_paterno, a.a_materno, a.escuela, a.celular, dap.rol
                        FROM alumno a
                        JOIN detalle_alumno_proyecto dap ON a.codigo = dap.codigo_alumno
                        WHERE dap.id_proyecto = '$IdPro';";
                        $Xyz = mysqli_query($cn, $VerMiembros);
                        
                        while ($datos = mysqli_fetch_array($Xyz)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $datos["codigo"] ?>
                                </td>
                                <td>
                                    <?php echo $datos["nombre"] ." ". $datos["a_paterno"] . " " . $datos["a_materno"] ?>
                                </td>
                                <td>
                                    <?php echo $datos["rol"] ?>
                                </td>
                                <td>
                                    <?php echo $datos["escuela"] ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>