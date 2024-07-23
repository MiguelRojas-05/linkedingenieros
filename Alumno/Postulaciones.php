<?php

include '../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

// Consulta SQL que básicamente hace es contar la cantidad de postulaciones que tiene un alumno en específico.
// Cambiar el código de alumno, ya que es un ejemplo.
$c=$_SESSION["codigo_usuario"];
$Sql = "select count(*) as cantidad from postulacion
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
    <title>Postulación</title>
    <link rel="stylesheet" href="../css/EstiloPracticasLaborales.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>
<h5 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;"></h5>

<body>
<?php  
include '../Componentes/NavBarAlumno.php';
?>

    <br><br><br><br>
    <?php
    //  Si el alumno no tiene postulaciones, ingresará al 'if' y mostrará un mensaje.
    if ($Total1 == 0) {
        echo '<center>
        <h5 class="text">
        Ahún no se a postulado a ninguna propuesta laboral.
        </h5>
        </center>';
        echo '<div class="a-cv">
        <a href="PropuestaLaboral.php">Ver propuestas laborales</a>
        </div>';
        //  Si el alumno al menos tiene 1 postulación, ingresará al 'else' y mostrará sus postulaciones que hizo.
    } else {
    ?>
        <table align="center" width="900" class="tb-propuesta">
            <tr>
                <td>EMPRESA</td>
                <td>LOGO</td>
                <td>PROPUESTA</td>
                <td>FECHA DE POSTULACIÓN</td>
                <td>ESTADO</td>
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
                $SqlPostulaciones = "select p.*, e.razon_social, pl.* from propuesta_laboral p
                inner join empresa e on p.codigo_empresa=e.codigo
                inner join postulacion pl on p.id=pl.id_propuesta
                where pl.codigo_alumno='$c'
                limit $Limite3,6";
            } else {
                /*Consulta SQL que básicamente hace que se seleccionen todas las postulaciones que un alumno en 
                específico ha hecho a una o varias propuestas laborales.
                Por otro lado, se limita el número de postulaciones  devueltos de la
                tabla propuesta_laboral, el cual se mostrará solamente de 6 en 6.
                */
                $SqlPostulaciones = "select p.*, e.razon_social,e.codigo, pl.* from propuesta_laboral p
                inner join empresa e on p.codigo_empresa=e.codigo
                inner join postulacion pl on p.id=pl.id_propuesta
                where pl.codigo_alumno='$c'
                limit 0,6";
            }

            $f = mysqli_query($cn, $SqlPostulaciones);
            while ($Registro = mysqli_fetch_assoc($f)) {
                $emp_cod = $Registro["codigo"];
            ?>

                <tr>
                    <td><a target="_blank" href="../PerfilEmpresa.php?codigo=<?php echo $emp_cod ; ?>"><?php echo $Registro["razon_social"]; ?></a></td>
                    <!-- Se extrae el logo de la empresa desde una carpeta, para este ejemplo utilize una carpeta llamada "LogoEmpresa"
                donde se almacenan los logos con el codigo de empresa, cambiar el nombre de la carpeta en 'src' si se llamará
                de otro modo. Importante que al momento del registro del logo o foto de la empresa (el cual se encarga otro),
                esta debe estar guardada por el codigo de empresa y en la carpeta donde se almacenará todos estas fotos de las
                empresas. -->
                    <td><img src="../FotoPerfil/Empresas/<?php echo $Registro["codigo_empresa"]; ?>.jpg" width="70" height="50"></td>
                    <td><?php echo $Registro["nombre"]; ?></td>
                    <td><?php echo $Registro["fecha_postulacion"]; ?></td>
                    <td><?php echo $Registro["estado"]; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <br>
        <center>
            <?php
            /* Consulta SQL que básicamente hace es contar el número de filas osea las postulaciones que un alumno en
            específico a hecho a una o varias propuestas laborales. */
            $SqlTotal = "select count(*) as cantidad from postulacion
            where codigo_alumno='$c'";

            $FilaTotal = mysqli_query($cn, $SqlTotal);
            $RegistroTotal = mysqli_fetch_assoc($FilaTotal);

            $Total = $RegistroTotal["cantidad"];

            $CantidadRegistroPorPagina = 6;

            $NumeroPaginas = ceil($Total / $CantidadRegistroPorPagina);

            for ($i = 0; $i < $NumeroPaginas; $i++) {

                $Limite4 = $i * $CantidadRegistroPorPagina;

                echo "<a target='_parent' href='Postulaciones.php?limi=$Limite4'>" . ($i + 1) . "</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            ?>
        </center>
    <?php
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>