<?php
include '../Auth/Alumno.php';
// Conexión a la base de datos.
include("../Conexion.php");

$c = $_SESSION["codigo_usuario"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Habilidades</title>
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
    <form action="ProcesoAgregarHabilidad.php" method="post">
        <table width="500" class="tb-oferta">
            <tr>
                <td align="center">Seleccionar Habilidad</td>
            </tr>
            <tr>
                <td>
                    <select name="lsthabilidad" class="lst-habilidad">
                    <?php
                    $Sql="SELECT * 
                        FROM habilidad 
                        WHERE id NOT IN (
                        SELECT d.id_habilidad
                        FROM detalle_habilidad_alumno d 
                        WHERE d.codigo_alumno = '$c'
                        );";

                    $Resultado=mysqli_query($cn,$Sql);

                    while($Registro = mysqli_fetch_assoc($Resultado)){
                        
                    ?>
                        
                        <option value="<?php echo $Registro["id"]; ?>"><?php echo $Registro["descripcion"]; ?></option>
                        
                        
                    <?php
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center">Nivel</td>
            </tr>
            <tr>
                <td align="center">
                    <input type="radio" name="nivel" class="input-radio" value="Básico" >Básico   
                    <input type="radio" name="nivel" class="input-radio" value="Intermedio">Intermedio
                    <input type="radio" name="nivel" class="input-radio" value="Avanzado" >Avanzado
                </td>
            </tr>
            <tr>
                <td align="center"><input type="submit" value="AGREGAR HABILIDAD"></td>
            </tr>
        </table>

    </form>
    <br>
    <table width="500">
        <tr>
            <td colspan="2" align="right">
                <a class="btn btn-sm btn-secondary" href="MisHabilidades.php" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Regresar
                </a>
            </td>
        </tr>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>