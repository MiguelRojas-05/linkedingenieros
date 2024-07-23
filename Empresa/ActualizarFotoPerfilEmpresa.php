<?php
include '../Auth/Empresa.php';
// Conexión a la base de datos.
include '../Conexion.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa - Actualizar Foto</title>
    <link rel="stylesheet" href="../css/EstilosActualizar.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
</head>
<body>
<?php  
include '../Componentes/NavBarEmpresa.php';
?>
    <br><br>
    <fieldset class="grupito">
        <br>
        <center>
            <h6 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                Por favor, ingrese su nueva foto de perfil de Empresa.
            </h6>
        </center>
        <br>
        <form action="ProcesoFotoPerfilEmpresa.php" method="post" enctype="multipart/form-data">
            <table align="center">
                <tr>
                    <td colspan="2" align="center" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                        Subir Foto(Solo .png, .jpg)
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
    <br>
    <table width="440">
        <tr>
            <td colspan="2" align="right">
                <a class="btn btn-sm btn-secondary" href="FotoPerfilEmpresa.php" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Regresar
                </a>
            </td>
        </tr>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>