<?php
include '../Auth/Docente.php';
include '../Conexion.php';

$c=$_SESSION["codigo_usuario"];

$Sql = "select * from docente
where codigo='$c'";

$Fila=mysqli_query($cn,$Sql);
$Registro=mysqli_fetch_assoc($Fila);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docente - Actualizar Datos</title>
    <link rel="stylesheet" href="../css/EstiloActualizar.css" type="text/css">
    <link rel="icon" href="../img/Min_logo.png" ; type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/VariablesGenerales.css">
    
</head>
<body>
<?php  
include '../Componentes/NavBarDocente.php';
?>
    <br><br>
    <form action="ProcesoActualizarPerfilDocente.php" method="post">
        <br><br>
            <center>
                <h4 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    ACTUALIZAR PERFIL
                </h4>
            </center>
            <table border="0" width="460" class="tb-apd">
                <tr>
                    <td colspan="2">Nombre(s)</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="txtnombre"  value="<?php echo $Registro["nombre"];?>">
                    </td>
                </tr>
                <tr>
                    <td>Apellido Paterno</td>
                    <td>Apellido Materno</td>
                </tr>
                <tr>
                    <td><input type="text" name="txtap" value="<?php echo $Registro["a_paterno"];?>" ></td>
                    <td><input type="text" name="txtam" value="<?php echo $Registro["a_materno"];?>" ></td>
                </tr>
                <tr>
                    <td colspan="2">Correo Electrónico</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="email" name="txtemail" value="<?php echo $Registro["correo"];?>" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="GUARDAR" class="btn-guardar">
                    </td>
                </tr>
            </table>
    </form>
    <br>
    <center>
        <h5 style="color: green; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
        <?php
        if(isset($_GET["mensaje3"])){
            $Mensaje=$_GET["mensaje3"];
        echo "$Mensaje";
        }else{

        }
        ?>
        </h5>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
</body>
</html>