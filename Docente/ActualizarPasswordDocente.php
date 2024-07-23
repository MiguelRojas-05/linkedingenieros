<?php
include '../Auth/Docente.php';
include '../Conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docente - Actualizar Password</title>
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
    <link rel="stylesheet" href="../css/EstiloActualizar.css?ver=1.5">
</head>
<body>
<?php  
include '../Componentes/NavBarDocente.php';
?>
    <br><br>
    <form action="ProcesoPasswordDocente.php" method="post">
        <center>
            <h3 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">ACTUALIZAR CONTRASEÑA</h3>
        </center>
        <table border="0" width="360" class="tb-pass">
            <br>
            <tr>
                <td>Escriba su contraseña anterior</td>
            </tr>
            <tr>
                <td><input type="password" name="txtpass"></td>
            </tr>
            <tr>
                <td>Escribir nueva contraseña</td>
            </tr>
            <tr>
                <td><input type="password" name="txtnuevopass"></td>
            </tr>
            <tr>
                <td>Repita nueva contraseña</td>
            </tr>
            <tr>
                <td><input type="password" name="txtrepass"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Cambiar Contraseña" class="btn-pass"></td>
            </tr>
        </table>
    </form>
    <br>
    <center>
        <h5 style="color: red; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
        <?php
        if(isset($_GET["e"])){
            echo "La nueva contraseña debe ser mayor<br>o igual a 8 dígitos";
        }else if(isset($_GET["e2"])){
            echo "Las contraseñas no coinciden";
        }else if(isset($_GET["e3"])){
            echo "Escriba bien su contraseña antigua";
        }
        ?>
        </h5>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>