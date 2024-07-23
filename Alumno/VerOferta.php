<?php
include '../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

// Extrayendo el valor de la variable 'id' que llega desde la url, esto para capturar el id de la propuesta.
$IdPropuesta = $_GET["id"];

$Sql = "select * from propuesta_laboral
    where id=$IdPropuesta";

$Fila = mysqli_query($cn, $Sql);
$Registro = mysqli_fetch_assoc($Fila);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Ofertat</title>
    <link rel="stylesheet" href="../css/EstiloPracticasLaborales.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>

<body>

<?php  
include '../Componentes/NavBarAlumno.php';
?>

    <br><br><br>
    <!-- Se envia un paramentro desde la URL el cual tendrá el id de la propuesta a postular. -->
    <form action="ProcesoPostular.php?idp=<?php echo $Registro["id"]; ?>" method="post">
        <table width="700" class="tb-oferta">
            <tr>
                <td colspan="2" align="center"><?php echo $Registro["nombre"]; ?></td>
            </tr>
            <tr>
                <td align="center">DESCRIPCION</td>
                <td><?php echo nl2br($Registro["descripcion"]); ?></td>
            </tr>
            <tr>
                <td align="center">REQUERIMIENTOS</td>
                <td><?php echo nl2br($Registro["requerimientos"]); ?></td>
            </tr>
            <tr>
                <td align="center">FECHA LIMITE</td>
                <td align="center"><?php echo $Registro["fecha_limite"]; ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="POSTULAR"></td>
            </tr>
        </table>

    </form>
    <br>
    <table width="700">
        <tr>
            <td colspan="2" align="right">
                <a class="btn btn-sm btn-secondary" href="PropuestaLaboral.php" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Regresar
                </a>
            </td>
        </tr>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>