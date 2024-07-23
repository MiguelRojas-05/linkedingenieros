<?php
include '../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

// Consulta SQL que realiza una consulta a la tabla alumno donde se busca la columa donde el valor
// de la columna codigo sea igual al codigo de alumno puesto. Cambiar el codigo, ya que es un ejemplo
$c = $_SESSION["codigo_usuario"];
$Sql = "select * from alumno
        where codigo='$c'";

$FilaTotal1 = mysqli_query($cn, $Sql);
$RegistroTotal1 = mysqli_fetch_assoc($FilaTotal1);
$Curriculum = $RegistroTotal1["cv"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum</title>
    <link rel="stylesheet" href="../css/EstiloPracticasLaborales.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>


<?php  
include '../Componentes/NavBarAlumno.php';
?>

    <?php
    // Si el alumno  registro su cv, ingresará al 'if' y mostrará un mensaje, pero si aún no registro su cv ingresará al 'else'
    if ($Curriculum == 2) {
        echo '<center>
        <h5 class="text">
        Usted ya registró su currículum vitae.
        </h5>
        </center><br>';
        echo '<div class="a-cv">
                <a href="ActualizarCurriculum.php">Actualizar currículum vitae</a>
            </div>';
        // Si el alumno aún no registro su cv, ingresará al 'else' y mostrará un cuadro donde le pida ingresar su cv.
    } else {
    ?>
        <fieldset class="grupito">
            <br>
            <center>
                <h6 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Por favor, registre su curriculum vitae para que pueda ingresar al apartado de propuestas laborales.
                </h6>
            </center>
            <br>
            <form action="ProcesoCurriculum.php" method="post" enctype="multipart/form-data">
                <table align="center">
                    <tr>
                        <td colspan="2" align="center" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                            Subir curriculum(Solo .doc, .dcox, .pdf)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="file" name="archivo" class="btn-archivo" required accept=".pdf, .doc, .docx"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Guardar Curriculum" class="btn-guardar"></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    <?php
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>