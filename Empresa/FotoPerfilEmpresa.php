<?php
include '../Auth/Empresa.php';
// Conexión a la base de datos.
include("../Conexion.php");

$c = $_SESSION["codigo_usuario"];
// Nombre de la carpeta y el nombre base de la imagen
$Carpeta = "../FotoPerfil/Empresas/";
$NombreImagen = "$c";
// Posibles extensiones de la imagen
$Extensiones = ['jpg', 'png'];
// Variable para almacenar la ruta de la imagen si se encuentra
$RutaImagen = "";
// Verificar si la imagen existe con alguna de las extensiones
foreach ($Extensiones as $Extension) {
    $RutaTemp = $Carpeta . $NombreImagen . '.' . $Extension;
    if (file_exists($RutaTemp)) {
        $RutaImagen = $RutaTemp;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa - Foto de Perfil</title>
    <link rel="stylesheet" href="../css/EstilosActualizar.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>
<body>

<?php  
include '../Componentes/NavBarEmpresa.php';
?>

    <?php
    // Si el alumno  registro su cv, ingresará al 'if' y mostrará un mensaje, pero si aún no registro su cv ingresará al 'else'
    if (!empty($RutaImagen)) {
        echo '<center>
        <h4 class="text">
        FOTO DE PERFIL
        <br><br>
        <img src="'.$RutaImagen.'" width="150" height"150">
        </h4>
        </center><br>';
        echo '<div class="a-cv">
                <a href="ActualizarFotoPerfilEmpresa.php">Actualizar foto de Perfil</a>
            </div>';
        // Si el alumno aún no registro su cv, ingresará al 'else' y mostrará un cuadro donde le pida ingresar su cv.
    } else {
    ?>
        <fieldset class="grupito">
            <br>
            <center>
                <h6 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Por favor, registre su foto de Perfil de Empresa.
                </h6>
            </center>
            <br>
            <form action="ProcesoFotoPerfilEmpresa.php" method="post" enctype="multipart/form-data">
                <table align="center">
                    <tr>
                        <td colspan="2" align="center" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                            Subir foto(Solo .png, .jpg)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="file" name="foto" class="btn-archivo" required accept=".png, .jpg"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Guardar Foto" class="btn-guardar"></td>
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