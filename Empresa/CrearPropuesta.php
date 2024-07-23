<?php
include '../Auth/Empresa.php';
include '../Conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion De Propuesta</title>
    <link rel="stylesheet" href="../css/EstiloCrearPropuesta.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/VariablesGenerales.css">
</head>

<body>
<?php  
include '../Componentes/NavBarEmpresa.php';
?>


    <div class="ContainerPropuesta" style="margin-top: 120px;">
        <img src=" ../img/Propuesta.png" width="240" height="185" alt="Logo">
        <h1>CREACIÓN DE PROPUESTA LABORAL</h1>

        <form action="ProcesoCrearPropuesta.php" method="post">
            <table>
                <tr>
                    <td class="Eti"><b>Nombre:</b></td>
                    <td><textarea input type="text" name="TxtNombre" required></textarea></td>
                </tr>
                <tr>
                    <td class="Eti"><b>Descripción:</b></td>
                    <td><textarea input type="text" name="TxtDescripcion" required></textarea></td>
                </tr>
                <tr>
                    <td class="Eti"><b>Requerimientos:</b></td>
                    <td><textarea input type="text" name="TxtRequerimientos" required></textarea></td>
                </tr>
                <tr>
                    <td class="Eti"><b>Fecha Límite:</b></td>
                    <td><input type="date" name="FechaLimite" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="center" style="text-align: right;">
                        <input type="submit" value="CREAR" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; text-decoration: none;">
                        <a href="IndexEmpresa.php" style="margin-left: 90px; padding: 8px 10px; background-color: #6c757d; color: white; border: none; border-radius: 5px; text-decoration: none;">Cancelar</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>