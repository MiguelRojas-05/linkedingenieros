<?php
include '../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

$c=$_SESSION["codigo_usuario"];

$Sql = "select count(*) as cantidad from detalle_habilidad_alumno
        where codigo_alumno='$c'";

$FilaTotal1 = mysqli_query($cn, $Sql);
$RegistroTotal1 = mysqli_fetch_assoc($FilaTotal1);
$Total1 = $RegistroTotal1["cantidad"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Habilidades</title>
    <link rel="stylesheet" href="../css/EstilosActualizar.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

<?php  
include '../Componentes/NavBarAlumno.php';
?>

    <br><br><br>
    <?php
    //  Si el alumno no tiene postulaciones, ingresará al 'if' y mostrará un mensaje.
    if ($Total1 == 0) {
        echo '<center>
        <h5 class="text">
        Usted aún no registra ninguna habilidad a tener.
        </h5>
        </center>';
        //  Si el alumno al menos tiene 1 postulación, ingresará al 'else' y mostrará sus postulaciones que hizo.
    } else {
    ?>
        <table align="center" width="700" class="tb-propuesta">
            <tr style="background-color: lightgrey;">
                <td>HABILIDAD</td>
                <td>NIVEL</td>
                <td>OPCIÓN</td>
            </tr>

            <?php

            if (isset($_GET["limi"])) {
                // $Limite3 almacena el parámetro que llega desde la URL
                $Limite3 = $_GET["limi"];
                /*Consulta SQL que básicamente hace que se seleccionen todas las postulaciones que un alumno en 
                específico ha hecho a una o varias propuestas laborales.
                Por otro lado, se limita el número de postulaciones  devueltos de la
                tabla propuesta_laboral, el cual se mostrará solamente de 6 en 6.
                */
                $SqlHabilidad = "select d.*, h.descripcion from detalle_habilidad_alumno d
                inner join habilidad h on d.id_habilidad=h.id
                where d.codigo_alumno='$c'
                limit $Limite3,6";
            } else {
                /*Consulta SQL que básicamente hace que se seleccionen todas las postulaciones que un alumno en 
                específico ha hecho a una o varias propuestas laborales.
                Por otro lado, se limita el número de postulaciones  devueltos de la
                tabla propuesta_laboral, el cual se mostrará solamente de 6 en 6.
                */
                $SqlHabilidad = "select d.*, h.descripcion from detalle_habilidad_alumno d
                inner join habilidad h on d.id_habilidad=h.id
                where d.codigo_alumno='$c'
                limit 0,6";
            }

            $f = mysqli_query($cn, $SqlHabilidad);
            while ($Registro = mysqli_fetch_assoc($f)) {
            ?>

                <tr>
                    <td><?php echo $Registro["descripcion"]; ?></td>
                    <td><?php echo $Registro["nivel"]; ?></td>
                    <td>
                        <a class="btn btn-sm btn-danger" href="ProcesoEliminarHabilidad.php?id=<?php echo $Registro["id_habilidad"]; ?>" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <br>
        <center>
            <?php
            /* Consulta SQL que básicamente hace es contar el número de filas osea las habilidades que un alumno en
            específico a escogido. */
            $SqlTotal = "select count(*) as cantidad from detalle_habilidad_alumno
            where codigo_alumno='$c'";

            $FilaTotal = mysqli_query($cn, $SqlTotal);
            $RegistroTotal = mysqli_fetch_assoc($FilaTotal);

            $Total = $RegistroTotal["cantidad"];

            $CantidadRegistroPorPagina = 6;

            $NumeroPaginas = ceil($Total / $CantidadRegistroPorPagina);

            for ($i = 0; $i < $NumeroPaginas; $i++) {

                $Limite4 = $i * $CantidadRegistroPorPagina;

                echo "<a target='_parent' href='MisHabilidades.php?limi=$Limite4'>" . ($i + 1) . "</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            ?>
        </center>
    <?php
    }
    ?>
    <br>
    <table width="700">
        <tr>
            <td colspan="2" align="right">
                <a class="btn btn-sm btn-secondary" href="HabilidadesAlumno.php" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Escoger habilidad
                </a>
            </td>
        </tr>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>