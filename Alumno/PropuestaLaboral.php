<?php
include '../Auth/Alumno.php';

// Conexión a la base de datos.
include("../Conexion.php");
// Consulta SQL que selecciona la tabla alumno y solo muestre la fila, osea el registro del codigo de alumno en específico.
$c = $_SESSION["codigo_usuario"];
$Sql = "select * from alumno
        where codigo='$c'";

$ResultadoTotal1 = mysqli_query($cn, $Sql);
$RegistroTotal1 = mysqli_fetch_assoc($ResultadoTotal1);
$Curriculum = $RegistroTotal1["cv"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno - Propuestas laborales</title>
    <link rel="stylesheet" href="../css/EstiloPracticasLaborales.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

<?php  
include '../Componentes/NavBarAlumno.php';
?>

    <br><br><br><br>
    <div></div>
    <?php
    // Si el alumno aún no registro su cv, ingresará al 'if' y mostrará un mensaje, pero si registro su cv ingresará al 'else'
    if ($Curriculum == 1) {
        echo '<center>
        <h5 class="text">
        Usted aún no registró su currículum vitae para que pueda acceder a las propuestas laborales.
        </h5>
        </center>';
        echo '<div class="a-cv">
                <a href="Curriculum.php">Registre aquí</a>
            </div>';
        // Si el alumno registro su cv, ingresará al 'else' y mostrará todas las propuestas laborales
    } else {
    ?>
        <table align="center" width="800" class="tb-propuesta">
            <tr>
                <td>EMPRESA</td>
                <td>LOGO</td>
                <td>PROPUESTA</td>
                <td>OPCIONES</td>
            </tr>

            <?php
            // Verifica si llega un parámetro específico a la URL
            if (isset($_GET["lim"])) {
                // $Limite almacena el parámetro que llega desde la URL
                $Limite = $_GET["lim"];
                /*Consulta SQL que básicamente hace que se seleccionen todas las propuestas que esten activas y que el
                alumno aún no se ha postulado, para este ejemplo p.id_estado_propuesta = 1, cambiar el numero del estado si el 
                estado 'activa' es otro id, sino dejarlo así. Al igual que el codigo de alumno, ya que es un ejemplo el
                código puesto en la consulta.
                Por otro lado, se limita el número de prupuestas devueltos de la
                tabla propuesta_laboral, el cual se mostrará solamente de 6 en 6.
                */
                $SqlPropuestaLaboral = "select p.*, e.razon_social 
                FROM propuesta_laboral p 
                INNER JOIN empresa e ON p.codigo_empresa = e.codigo 
                WHERE p.id_estado_propuesta = 1 
                AND p.id NOT IN (
                    SELECT po.id_propuesta
                    FROM postulacion po 
                    WHERE po.codigo_alumno = '$c'
                ) 
                LIMIT $Limite, 6";
            } else {
                /*Consulta SQL que básicamente hace que se seleccionen todas las propuestas que esten activas y que el
                alumno aún no se ha postulado, para este ejemplo p.id_estado_propuesta = 1, cambiar el numero del estado si el 
                estado 'activa' es otro id, sino dejarlo así. Al igual que el codigo de alumno, ya que es un ejemplo el
                código puesto en la consulta.
                Por otro lado, se limita el número de prupuestas devueltos de la
                tabla propuesta_laboral, el cual se mostrará solamente de 6 en 6.
                */
                $SqlPropuestaLaboral = "select p.*, e.razon_social 
                FROM propuesta_laboral p 
                INNER JOIN empresa e ON p.codigo_empresa = e.codigo 
                WHERE p.id_estado_propuesta = 1 
                AND p.id NOT IN (
                    SELECT po.id_propuesta
                    FROM postulacion po 
                    WHERE po.codigo_alumno = '$c'
                ) 
                LIMIT 0, 6";
            }
            // Se ejecuta la consulta SQL y se almacena el resultado de la consulta en la variable $resultado. 
            $Resultado = mysqli_query($cn, $SqlPropuestaLaboral);
            while ($Registro = mysqli_fetch_assoc($Resultado)) {


            ?>

                <tr>
                    <td><?php echo $Registro["razon_social"]; ?></td>
                    <!-- Se extrae el logo de la empresa desde una carpeta, para este ejemplo utilize una carpeta llamada "LogoEmpresa"
                donde se almacenan los logos con el codigo de empresa, cambiar el nombre de la carpeta en 'src' si se llamará
                de otro modo. Importante que al momento del registro del logo o foto de la empresa (el cual se encarga otro),
                esta debe estar guardada por el codigo de empresa y en la carpeta donde se almacenará todos estas fotos de las
                empresas. -->
                    <td><img src="../FotoPerfil/Empresas/<?php echo $Registro["codigo_empresa"]; ?>.jpg" width="70" height="50"></td>
                    <td><?php echo $Registro["nombre"]; ?></td>
                    <td>
                        <!-- Se envia un paramentro desde la URL el cual tendrá el id de la propuesta seleccionada.-->
                        <a href="VerOferta.php?id=<?php echo $Registro["id"]; ?>">
                            <img src="../img/propuesta.png" width="50" height="50">
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
            /* Consulta SQL que básicamente hace es contar el número de filas osea de las propuestas que estean activas
            y de las que ahún el alumno no se ah postulado de la tabla propuesta_laboral. Cambiar el numero del estado si el estado 
            'activa' es otro id, sino dejarlo así. Al igual que el codigo de alumno, ya que es un ejemplo el codigo puesto. */
            $SqlTotal = "select count(*) as cantidad 
            FROM propuesta_laboral 
            WHERE id_estado_propuesta = 1 
            AND id NOT IN (
                SELECT po.id_propuesta
                FROM postulacion po 
                WHERE po.codigo_alumno = '$c'
            )";

            $ResultadoTotal = mysqli_query($cn, $SqlTotal);
            $RegistroTotal = mysqli_fetch_assoc($ResultadoTotal);

            $Total = $RegistroTotal["cantidad"];

            $CantidadRegistroPorPagina = 6;

            $NumeroPaginas = ceil($Total / $CantidadRegistroPorPagina);

            for ($i = 0; $i < $NumeroPaginas; $i++) {
                // code...

                $Limite2 = $i * $CantidadRegistroPorPagina;

                echo "<a target='_parent' href='PropuestaLaboral.php?lim=$Limite2'>" . ($i + 1) . "</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            ?>
        </center>
    <?php
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>